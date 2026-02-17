<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB; 
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;


class SalesReportController extends Controller
{
    //sales report
    public function report()
    {
        $salesData = [];
        $orders = Order::with('orderItems.product')->get();


        $totalSales = 0;
        $totalCosts = 0;



        foreach ($orders as $order) {

            $orderTotalAmount = $order->orderItems->sum(function($item){
                return $item->quantity * $item->unit_price;
            });

            $orderTotalCost = ($orderTotalAmount-($orderTotalAmount*0.5)) - 10;


            $salesData[] = [
                'order_id' => $order->order_id, 
                'order_date' => $order->order_date, 
                'total_amount' => $orderTotalAmount,
                'total_costs' => $orderTotalCost,

                


                
            ];

            $totalSales += $orderTotalAmount;
            $totalCosts += $orderTotalCost;
        }
    
        // Fixing the order_items join query
        $productSales = OrderItem::join('products', 'order_items.product_id', '=', 'products.product_id')
            ->select('products.product_name', DB::raw('SUM(order_items.quantity) as total_quantity'))
            ->groupBy('products.product_name')
            ->orderByDesc('total_quantity')
            ->get();

        $mostSellingProduct = $productSales->first();
        $leastSellingProduct = $productSales->last();

        return view('sales_report', [
            'salesData' => $salesData,
            'mostSellingProduct' => $mostSellingProduct,
            'leastSellingProduct' => $leastSellingProduct,
            'totalSales' => $totalSales,
            'totalCosts' => $totalCosts,

        ]);
    }




    
}

