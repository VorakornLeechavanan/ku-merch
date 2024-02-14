<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemManagementController;

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

Route::post('insert', 
[ItemManagementController::class,'insert']
);

Route::get('login', function () {
    return view('login');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
