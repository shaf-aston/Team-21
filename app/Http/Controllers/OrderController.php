<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    //

    public function adminIndex(){
        $orders = Order::with(['user', 'orderItems.product'])->get();
        return view('orders.adminIndex', compact('orders'));
    }

    public function index(){
        $user = auth()->user();

        $orders = Order::where('user_id', $user->id)
            ->orderBy('order_date', 'desc')
            ->get();

        return view('orders.index', compact('orders'));
    }

    public function adminShow($order_id)
{
    $order = Order::with(['orderItems.product'])->findOrFail($order_id);
    return view('orders.adminShow', compact('order'));
}

    public function show($order_id)
{
    $order = Order::with(['orderItems.product'])->findOrFail($order_id);
    return view('orders.show', compact('order'));
}

    public function editStatus(Order $order){
        return view('orders.editstatus', compact('order'));

    }

    public function updateStatus(Request $request, Order $order)
    {
       
        
        $request->validate([
            'order_status' => 'required|in:pending,shipped,delivered,canceled',
        ]);
    
        $order->update(['order_status' => $request->order_status]);
    
        return redirect()->route('orders.adminIndex');



    }



public function returnItem($itemId)
{


    // Load the order item with product data
    $item = OrderItem::with('product', 'order')->find($itemId);

    if (!$item) {

        return redirect()->back()->with('error', 'Item not found.');
    }



    // Ensure the order is delivered before allowing return
    if ($item->order->order_status !== 'delivered') {

        return redirect()->back()->with('error', 'You can only return items from delivered orders.');
    }

    // Restore stock quantity for the product
    if ($item->product) {

        $item->product->increment('stock_quantity', $item->quantity);
    }

    // Delete the item from the order

    $item->delete();

    // Check if the order is now empty and update status
    if ($item->order->orderItems()->count() == 0) {

        $item->order->update(['order_status' => 'canceled']);
    }

    return redirect()->back()->with('success', 'Item returned successfully. Stock updated.');
}

public function sortResults(Request $request)
{
    // Get sorting parameters
    $sortBy = $request->query('sort_by', 'order_id');
    $sortOrder = $request->query('sort_order', 'asc');

    // Retrieve and sort all orders
    $orders = Order::orderBy($sortBy, $sortOrder)->get();

    return view('adminsort.result', compact('orders', 'sortBy', 'sortOrder'));
}


}
