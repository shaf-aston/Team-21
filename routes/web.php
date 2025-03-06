<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WishListController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\CustomerDetailsController;
use App\Http\Controllers\SalesReportController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\DB;


Route::get('/', function () {
  return redirect('/home');
});

//return search bar form
Route::get('/searchbar', function () {
  return view('search.form');
});

//return search value
Route::get('/search', [SearchController::class, 'search'])->name('search');

//return the main page
Route::get('/nav', function () {
  return view('signup');
});

// Show the login form
Route::get('/login', function () {
  return view('signup');  // Using 'signup' as the view for login
})->name('login');

// Process the login request
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

//Route for logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Show the registration form
Route::get('/register', function () {
  return view('signup');  // Show 'signup' for the registration view
})->name('register');

// Process the registration request
Route::post('/register', [RegistrationController::class, 'register'])->name('register.post');

// For logout (optional if needed)
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

//return basket view
Route::get('/basket', function () {
  return view('basket');
});


//return about view
Route::get('/about',  function () {
  return view('about');
});


//return checkout view 
Route::get('/checkout2', function () {
  return view('checkout2');
});


//checkout form
Route::get('/checkout', [CheckoutController::class, 'showCheckout'])->name('checkout.show');
Route::post('/checkout', [CheckoutController::class, 'verifyCheckout'])->name('checkout.verify');

//routes for the contact form
Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');


// Basket Page
Route::get('/basket', [BasketController::class, 'index'])->name('basket.index');

// Add Product to Basket
Route::post('/basket/add', [BasketController::class, 'add'])->name('basket.add');

// Update Product Quantity in Basket
Route::put('/basket/{item}', [BasketController::class, 'update'])->name('basket.update');

// Remove Product from Basket
Route::delete('/basket/{item}', [BasketController::class, 'remove'])->name('basket.remove');

// Clear Basket
Route::delete('/basket/clear', [BasketController::class, 'clear'])->name('basket.clear');


Route::get('/home',  function () {
  return view('home');
});


Route::get('/products', function () {
  $products = DB::table('products')->get();
  return view('products', ['products' => $products]);
});
Route::get('/productdesc', function () {

  return view('productdesc');
})->name("productdesc");

Route::post(
  'products',
  [ProductController::class, 'index']
)->name("products.index");




Route::get('/adminproducts', function () {
  $products = DB::table('products')->get();
  return view('adminViewOfProduct', ['products' => $products]);
});

Route::post('adminproducts', [ProductController::class, 'adminIndex'])->name('adminproducts.index');

// Remove Product from Basket
Route::delete('/adminproducts/{item}', [ProductController::class, 'remove'])->name('admin.remove');




// Route for Laptops
Route::get('/Laptops', function () {
  $products = DB::table('products')->get();
  #$products = $products::where('category_id',1)->get();
  return view('Laptops', ['products' => $products]);
})->name("Laptops");
// Route for Smartwatches
Route::get('/Smartwatches', function () {
  $products = DB::table('products')->get();
  #$products = $products::where('category_id',1)->get();
  return view('Smartwatches', ['products' => $products]);
})->name("Smartwatches");
//Route for hpones
Route::get('/Phones', function () {
  $products = DB::table('products')->get();
  #$products = $products::where('category_id',1)->get();
  return view('Phones', ['products' => $products]);
})->name("Phones");
//Route for Tablets
Route::get('/Tablets', function () {
  $products = DB::table('products')->get();
  #$products = $products::where('category_id',1)->get();
  return view('Tablets', ['products' => $products]);
})->name("Tablets");
//Route for Accessories
Route::get('/Accessories', function () {
  $products = DB::table('products')->get();
  #$products = $products::where('category_id',1)->get();
  return view('Accessories', ['products' => $products]);
})->name("Accessories");

Route::post('/productssort',function() {
  $products = DB::table('products')->get();
  $sortby = request('sort');
  echo $sortby;
  if($sortby == 'priceasc'){
      $productsorted = $products->sortBy('product_price');
  }
  if($sortby == 'pricedesc'){
      $productsorted  = $products->sortByDesc('product_price');
  }
  if($sortby == 'nameasc'){
      $productsorted  = $products->sortBy('product_name');
  }
  if($sortby == 'namedesc'){
      $productsorted  = $products->sortByDesc('product_name');
  }
  if($sortby == 'default'){
      $productsorted = $products;
  }

  return view('products', ['products' => $productsorted ]);
});
#Route::get('/Laptops', [ProductController::class, 'showlap']);
Route::get('/productdesc/{product_id}', [ProductController::class, 'show'] );



Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('forgot.password.reset');



// Basket Page
Route::get('/wishlist', [WishListController::class, 'index'])->name('wishlist.index');

// Add Product to wish
Route::post('/wishlist/add', [WishListController::class, 'add'])->name('wishlist.add');

// Update Product Quantity in wish
Route::put('/wishlist/{item}', [WishListController::class, 'update'])->name('wishlist.update');

// Remove Product from wish
Route::delete('/wishlist/{item}', [WishListController::class, 'remove'])->name('wishlist.remove');

// Clear wish
Route::delete('/wishlist/clear', [WishListController::class, 'clear'])->name('wishlist.clear');

//creating a new product
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');



//upadting stock
Route::get('/products/{product}/update', [ProductController::class, 'update'])->name('products.update');
Route::post('/products/{product}/updateStock', [ProductController::class, 'updateStock'])->name('products.updateStock');

//review page routes 
Route::post('/products/{product}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
Route::get('/products/{product}/reviews', [ReviewController::class, 'show']);

//Display the form for details to be updated
Route::get('edit', [CustomerDetailsController::class, 'edit'])->name('customer.edit');

//The actual updating of the form
Route::post('update', [CustomerDetailsController::class, 'update'])->name('customer.update');

//Deletes the customer's data from the database
Route::post('delete', [CustomerDetailsController::class, 'delete'])->name('delete');

//Displays the sale report to the admin
Route::get('/sales-report', [SalesReportController::class, 'report']);


//Displays the orders 
Route::get('/adminorders', [OrderController::class, 'adminIndex'])->name('orders.adminIndex');

Route::get('/order', [OrderController::class, 'index'])
  ->middleware('auth')
  ->name('orders.index');

Route::get('/orders/{order_id}', [OrderController::class, 'show'])->name('orders.show');

Route::get('/adminorders/{order_id}', [OrderController::class, 'adminShow'])->name('orders.adminShow');

Route::get('/adminorders/{order}/editstatus', [OrderController::class, 'editStatus'])->name('orders.adminEditStatus');

Route::post('/adminorders/{order}/updatestatus', [OrderController::class, 'updateStatus'])->name('orders.adminUpdateStatus');

Route::get('/navbarpreview', function () {
  return view('components.navbar');
});

Route::get('/navtest', function () {
  return view('components.authbutton');
});

Route::get('/profile', function () {
  return view('customer-dash');
});

Route::get('/wishlist', function () {
  return view('Wishlist');
});