<?php

namespace App\Http\Controllers;


use App\Models\WishListItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class WishListController extends Controller
{
  //showing the wishlist of the user logged in
  public function index()
  {
    $wishListItems = WishListItem::where('user_id', Auth::id())->with('product')->get();
    return view('wishlist2', compact('wishListItems'));
  }


  //adding a product to the wishlist
  public function add(Request $request)
  {
    //validating user input
    $request->validate([
      'product_id' => 'required|exists:products,product_id',
      'quantity' => 'required|integer|min:1',
    ]);


    //making sure the user is logged in
    $userId = Auth::id();
    if (!$userId) {
      return redirect()->route('login')->with('error', 'Please login to add a product to wishlist');
    }

    //retreiving the product id and quantity
    $productId = $request->product_id;
    $quantity = $request->quantity;


    //get the wishlist item that is being added
    $wishListItem = WishListItem::where('user_id', Auth::id())->where('product_id', $productId)->first();


    //if it exists just increase quantity if not added it to the wishlist
    if ($wishListItem) {
      $wishListItem->quantity += $quantity;
      $wishListItem->save();
    } else {
      WishListItem::create([
        'user_id' => $userId,
        'product_id' => $productId,
        'quantity' => $quantity
      ]);
    }

    return redirect()->back()->with('success', 'product has been added to the wishlist');
  }


  //removing a product from the wishlist
  public function remove($id)
  {

    $wishListItem = WishListItem::where('user_id', Auth::id())->findOrFail($id);
    $wishListItem->delete();
    return redirect()->route('wishlist.index')->with('success', 'product has been removed from wishlist');
  }

  //shaf changing update
  //updating the quantity of the product in wishlist
  public function update(Request $request, $id)
  {
      try {
          $request->validate([
              'quantity' => 'required|integer|min:1',
          ]);
  
          $userId = Auth::id();
          if (!$userId) {
              return response()->json([
                  'success' => false,
                  'message' => 'User not authenticated'
              ], 401);
          }
  
          $wishListItem = WishListItem::where('user_id', $userId)->where('id', $id)->first();
          
          if (!$wishListItem) {
              return response()->json([
                  'success' => false,
                  'message' => 'Wishlist item not found'
              ], 404);
          }
  
          $wishListItem->update(['quantity' => $request->quantity]);
  
          return response()->json([
              'success' => true,
              'message' => 'Product quantity has been updated',
              'quantity' => $wishListItem->quantity,
          ]);
      } catch (\Exception $e) {
          return response()->json([
              'success' => false,
              'message' => 'Error: ' . $e->getMessage()
          ], 500);
      }
  }


  //clearing the wishlist for the user
  public function clear()
  {
    WishListItem::where('user_id', Auth::id())->delete();
    return redirect()->route('wishlist.index')->with('success', 'wishlist has been cleared');
  }
}
