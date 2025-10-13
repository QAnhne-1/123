<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\VariantController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\ProductController as ClientProductController;
use App\Models\Category;
use App\Models\Product;
use App\Models\Variant;

Route::get('/', function () {
    echo 'Home';
});

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'middleware' => 'checkAdmin'
], function() {
    // Index
    Route::get('/', [IndexController::class, 'index'])->name('index');

    // Category
    Route::group([
        'prefix' => 'categories',
        'as' => 'categories.'
    ], function() {
        Route::get('/', [CategoryController::class, 'listCategory'])->name('listCategory');
        Route::get('add-category', [CategoryController::class, 'addCategory'])->name('addCategory');
        Route::post('add-category', [CategoryController::class, 'addPostCategory'])->name('addPostCategory');
        Route::get('update-category/{id}', [CategoryController::class, 'updateCategory'])->name('updateCategory');
        Route::put('update-category/{id}', [CategoryController::class, 'updatePutCategory'])->name('updatePutCategory');
        Route::delete('delete-category', [CategoryController::class, 'deleteCategory'])->name('deleteCategory');
    });

    // Product
    Route::group([
        'prefix' => 'products',
        'as' => 'products.'
    ], function() {
        Route::get('/', [ProductController::class, 'listProduct'])->name('listProduct');
        Route::get('add-product', [ProductController::class, 'addProduct'])->name('addProduct');
        Route::post('add-product', [ProductController::class, 'addPostProduct'])->name('addPostProduct');
        Route::get('update-product/{id}', [ProductController::class, 'updateProduct'])->name('updateProduct');
        Route::put('update-product/{id}', [ProductController::class, 'updatePutProduct'])->name('updatePutProduct');
    });

    // Variant
    Route::group([
        'prefix' => 'variants',
        'as' => 'variants.'
    ], function() {
        Route::get('/', [VariantController::class, 'listVariant'])->name('listVariant');
        Route::get('add-variant', [VariantController::class, 'addVariant'])->name('addVariant');
        Route::post('add-variant', [VariantController::class, 'addPostVariant'])->name('addPostVariant');
        Route::get('update-variant/{id}', [VariantController::class, 'updateVariant'])->name('updateVariant');
        Route::put('update-variant/{id}', [VariantController::class, 'updatePutVariant'])->name('updatePutVariant');
    });
});


// Client
Route::group([
    'prefix' => 'product',
    'as' => 'product.'
], function() {
    Route::get('detail-product/{id}', [ClientProductController::class, 'detailProduct'])->name('detailProduct');
    Route::post('detail-product/{id}', [ClientProductController::class, 'detailProduct'])->name('detailProduct');
    Route::get('view-cart', [ClientProductController::class, 'viewCart'])->name('viewCart');
    Route::group([
        'middleware' => 'checkUser'
    ], function() {
        Route::post('add-to-cart', [ClientProductController::class, 'addToCart'])->name('addToCart');
        Route::patch('update-cart', [ClientProductController::class, 'updateCart'])->name('updateCart');
        Route::delete('delete-cart', [ClientProductController::class, 'deleteCart'])->name('deleteCart');
    });
});


// Index
Route::get('/', [HomeController::class, 'index'])->name('index');


Route::get('register',[AuthenticationController::class,'register'])->name('register');
Route::post('register',[AuthenticationController::class,'postRegister'])->name('postRegister');
Route::get('login',[AuthenticationController::class,'login'])->name('login');
Route::post('login',[AuthenticationController::class,'postLogin'])->name('postLogin');
Route::get('logout',[AuthenticationController::class,'logout'])->name('logout');
