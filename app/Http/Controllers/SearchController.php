<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    //the search function for search bar
    public function search(Request $request){
        $request->validate([
            'query' => 'required|string'
        ]);

        $query = $request->input('query');

        $products = Product::where('product_name', 'LIKE', "%{$query}%")
            ->orWhere('product_description', 'LIKE', "%{$query}%")
            ->get();

        return view('search.results', compact('products', 'query'));
        
    }


    public function productSearch(Request $request){
        $request->validate([
            'query' => 'required|string'
        ]);

        $query = $request->input('query');

        $products = Product::where('product_name', 'LIKE', "%{$query}%")
            ->orWhere('product_description', 'LIKE', "%{$query}%")
            ->get();

        return view('adminproductresult', compact('products', 'query'));
        
    }

    public function searchOrders(Request $request)
    {
        
        $request->validate([
            'query' => 'required|string'
        ]);
        
        $query = $request->input('query');

        // Search by order_id (exact match) or order_status (partial match)
        $orders = Order::where('order_id', $query)
                       ->orWhere('order_status', 'LIKE', "%{$query}%")
                       ->get();

        return view('adminSearch.result', compact('orders', 'query'));
    }





}
