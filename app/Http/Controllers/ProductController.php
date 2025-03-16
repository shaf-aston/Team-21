<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;


class ProductController extends Controller
{

    public function index(Request $request)
    {
        
        // Retrieve all products from the database
        $products = Product::all();

        $inputvalue = dump(request()->get('sort'));
        if($inputvalue != 'default'){
        $products = $products->sortBy($inputvalue);
        $result = compact('products');
        }
        else{
            $result = compact('products');
        }
        // Return a view and pass the data to it
        return view('products.index', $result);
    }
    
    public function show($product_id){
        return view('/productdesc', ['product' => Product::find($product_id)]);
    }

    public function remove($product_id){
        $product = Product::findorFail($product_id);
        $product->delete();
        

        return redirect()->route('adminproducts.index')->with('sucess', 'Product has been removed from database');
    }


    public function adminIndex(Request $request)
    {
        
        // Retrieve all products from the database
        $products = Product::all();

        $inputvalue = dump(request()->get('sort'));
        if($inputvalue != 'default'){
        $products = $products->sortBy($inputvalue);
        $result = compact('products');
        }
        else{
            $result = compact('products');
        }
        // Return a view and pass the data to it
        return view('adminproducts.index', $result);
    }

    public function adminShow($product_id){
        return view('adminproductShow', ['product' => Product::find($product_id)]);
    }

    public function create()
{
    return view('addingproduct');

}


    public function update(Product $product){
        return view('updatingproductinfo', compact('product'));
    }

public function store(Request $request)
{
    $validated = $request->validate([
        'product_name' => 'required|string|max:255',
        'product_price' => 'required|numeric|min:0',
        'stock_quantity' => 'required|integer|min:0',
        'product_description' => 'required|string', 
        'img_id' => 'required|integer', 
        'category_id' => 'required|integer',
        'created_at' => 'required|date_format:Y-m', 
        'updated_at' => 'required|date_format:Y-m', 
    ]);

    // Manually set created_at and updated_at
    $validated['created_at'] = now(); // or use your desired date, e.g., '2025-02-01'
    $validated['updated_at'] = now(); // use current timestamp

   
    Product::create([
        'product_name' => $validated['product_name'],
        'product_price' => $validated['product_price'],
        'stock_quantity' => $validated['stock_quantity'],
        'product_description' => $validated['product_description'],
        'img_id' => $validated['img_id'],
        'category_id'=> $validated['category_id'],
    ]);

    return redirect()->route('adminproducts.index')->with('success', 'Product added successfully!');
}


public function updateStock(Request $request, Product $product)
{
    $validated = $request->validate([
        'product_name'   => 'required|string|max:255',
        'product_price'  => 'required|numeric|min:0',
        'stock_quantity' => 'required|integer|min:0',
    ]);

    $product->update([
        'stock_quantity' => $validated['stock_quantity'],
        'product_price' => $validated['product_price']
    ]);

    return redirect()->route('adminproducts.index')->with('success', 'Stock updated successfully!');
}




    


}
