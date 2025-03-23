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

class StockReportController extends Controller
{
    //stock report
    public function stock_report(){
        $stockLevels = Product::select('product_name', 'stock_quantity', 'product_id')
            ->orderBy('stock_quantity', 'asc')
            ->get();

        

        $lowStockProducts = $stockLevels->filter(function($product){
            return $product->stock_quantity < 10;

        });

        return view ('stock_report', [
            'stockLevels' => $stockLevels,
            'lowStockProducts' => $lowStockProducts,
        ]);
    }
}
