<?php

namespace App\Http\Controllers;

use App\Models\SupplierOrder;
use App\Models\SupplierOrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SupplierOrderController extends Controller
{
  // Show the form to create a new supplier order
  public function create()
  {
    // Retrieve all products to display in the form
    $products = Product::all();
    return view('supplierorders.create', compact('products'));
  }

  // Store a newly created supplier order in storage

  public function store(Request $request)
  {
    try {
      $validated = $request->validate([
        'supplier_name' => 'required|string|max:255',
        'product_id' => 'required|array',
        'product_id.*' => 'exists:products,product_id',
        'quantity' => 'required|array',
        'quantity.*' => 'integer|min:1',
      ]);



      // Calculate total order price
      $totalPrice = 0;
      $items = [];

      foreach ($validated['product_id'] as $index => $productId) {
        $product = Product::findOrFail($productId);
        $discountedPrice = $product->product_price * 0.8;
        $quantity = $validated['quantity'][$index];
        $subtotal = $discountedPrice * $quantity;

        $totalPrice += $subtotal;

        $items[] = [
          'product_id' => $productId,
          'quantity' => $quantity,
          'unit_price' => $discountedPrice,
          'subtotal' => $subtotal,
        ];

        // Increase the stock_quantity of the ordered product by the ordered quantity
        $product->increment('stock_quantity', $quantity);  // Increment the stock quantity by the ordered quantity
      }

      // Create Supplier Order
      $supplierOrder = SupplierOrder::create([
        'supplier_name' => $validated['supplier_name'],
        'total_amount' => $totalPrice,
        'order_date' => now(),
        'created_at' => now(),
        'updated_at' => now(),
      ]);

      Log::info("Supplier Order Created: ID {$supplierOrder->id}");

      // Attach ordered items
      foreach ($items as $item) {
        SupplierOrderItem::create([
          'supplier_order_id' => $supplierOrder->id,
          'product_id' => $item['product_id'],
          'quantity' => $item['quantity'],
          'unit_price' => $item['unit_price'],
          'subtotal' => $item['subtotal'],
          'created_at' => now(),
          'updated_at' => now(),
        ]);
      }

      return redirect()->route('supplier-orders.index')->with('success', 'Supplier order placed successfully!');
    } catch (\Exception $e) {
      Log::error('Error in store(): ' . $e->getMessage());
      return redirect()->back()->with('error', 'Order failed: ' . $e->getMessage());
    }
  }

  // Display a list of all supplier orders
  public function index()
  {
    $supplierOrders = SupplierOrder::all();
    return view('supplierorders.index', compact('supplierOrders'));
  }

  // Display a specific supplier order
  public function show(SupplierOrder $supplierOrder)
  {
    $supplierOrder->load('supplierOrderItems.product');
    return view('supplierorders.show', compact('supplierOrder'));
  }
}
