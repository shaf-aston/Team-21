<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;


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
        $product->wishlistItems()->delete();
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
    return view('addproduct');

}

public function addproduct(Request $request) {
    // Validate request input
    $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric',
        'description' => 'required|string',
        'quantity' => 'required|integer',
        'categoryid' => 'required|numeric|between:1,5',
        'brand' => 'required|string|max:255',
        'colour' => 'required|string|max:50',
        'ram' => 'string|max:50',
        'image' => 'required|image|mimes:jpeg,png,jpg',
    ]);

    // Create a new product instance
    $product = Product::create([
        'product_name' => $request->name,
        'product_description' => $request->description,
        'product_price' => $request->price,
        'stock_quantity' => $request->quantity,
        'category_id' => $request->categoryid,
        'brand' => $request->brand,
        'colour' => $request->colour,
        'ram' => $request->ram,
        'popularityranking' => 0,
        'img_id' => 0,
    ]);

    // Update image ID to match product ID
    $product->img_id = $product->product_id;
    $product->save();

    // Handle image upload and rename to product ID
    $file = $request->file('image');
    $filename = $product->img_id . '.jpg';
    $file->move(public_path('images'), $filename);

    return redirect()->route('adminproducts.index')->with('success', 'Product created successfully!');
}







    public function update(Product $product){
        return view('updatingproductinfo', compact('product'));
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
