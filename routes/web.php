<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemManagementController;
use App\Http\Controllers\SaleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('catalog', 
[ItemManagementController::class,'display']
);

Route::get('catalog/create_item', function () {
    return view('create_item');
});

Route::get('catalog/add', function () {
    return view('add_quantity');
});

Route::get('catalog/remove', function () {
    return view('remove_quantity');
});

Route::get('catalog/delete', function () {
    return view('delete_product');
});


Route::get('history',
[SaleController::class,'display'] 
);

Route::get('history/{id}',
[SaleController::class,'receipt'] 
);

Route::post('insert', 
[ItemManagementController::class,'insert']
);

Route::post('remove', 
[ItemManagementController::class,'remove']
);

Route::post('apply', 
[SaleController::class,'add_cart_item']
);

Route::post('add_quantity', 
[ItemManagementController::class,'add_quantity']
);

Route::post('delete', 
[ItemManagementController::class,'delete']
);

Route::get('login', function () {
    return view('login');
});

Route::fallback(function () {
    return redirect('/'); // Redirect to the specified error page route
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
