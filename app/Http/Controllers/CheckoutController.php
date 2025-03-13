<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\model_name;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\BasketItem;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Shipping;

class CheckoutController extends Controller
{
  //showing the checkout form
  public function showCheckout()
  {
    return view('checkout2');
  }

  //validating the field display any errors
  public function verifyCheckout(Request $request)
  {
    //validate inputs
    $request->validate([
      'fullName' => 'required|string|max:255',
      'email' => 'required|email|max:255',
      'phone' => 'required|string|max:15',
      'address' => 'required|string|max:255',
      'city' => 'required|string|max:100',
      'zip' => 'required|string|max:10',
      'cardName' => 'required|string|max:255',
      'cardNumber' => 'required|digits:16',
      'expiryDate' => 'required|date_format:Y-m',
      'cvv' => 'required|digits:3',
    ]);
    //calculate the number of items in the basket
    $items = BasketItem::where('user_id', Auth::id())->with('product')->get();
    $itemstotal = 0;

    foreach ($items as $item) {
      $itemstotal += $item->quantity;
    }



    //add inputs to order table

    $userId = Auth::id();
    //create an order for the orders table
    $order = Order::create(['user_id' => $userId, 'order_date' => now()->format('Y-m-d H:i'), 'order_status' => 'PENDING', 'total_amount' => $itemstotal]);
    //create a shippingentry for the shipping table
    $shippingentry = Shipping::create(['order_id' => $order->order_id, 'shipping_address' => ($request->input('address') . ' ' . $request->input('city') . ' ' . $request->input('zip')), 'shipping_status' => 'PENDING', 'shipping_date' => now()->format('Y-m-d H:i')]);

    //create an orderitem for the orderitems table
    foreach ($items as $item) {
      $productprice = Product::where('product_id', $item->product_id)->value('product_price');
      OrderItem::create(['order_id' => $order->order_id, 'product_id' => $item->product_id, 'quantity' => $item->quantity, 'unit_price' => $productprice]);
      $product = Product::find($item->product_id);
      if ($product) {
        $product->decrement('stock_quantity', $item->quantity);
      }
    }

    BasketItem::where('user_id', Auth::id())->delete();
    //if(payment){insert data in payments table
    //}
    return redirect()->route('checkout.show')->with('success', 'Payment processed successfully!');
  }
}
