<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/detail/{id}', [DetailController::class, 'show']);

Route::prefix('admin')->group(function () {
  Route::get('/', [ProductController::class, 'index']);
  // Product
  Route::get('/products', [ProductController::class, 'index']);
  Route::get('/create-product', [ProductController::class, 'showCreateProduct']);
  Route::post('/create-product', [ProductController::class, 'createProduct']);
  Route::delete('/delete-product/{id}', [ProductController::class, 'deleteProduct']);
  Route::get('/update-product/{id}', [ProductController::class, 'showUpdateProduct']);
  Route::put('/update-product/{id}', [ProductController::class, 'updateProduct']);
  Route::delete('/delete-illustration/{illustration_path}', [ProductController::class, 'deleteIllutration']);

  // Category
  Route::get('/categories', [CategoryController::class, 'index']);
  Route::get('/create-category', [CategoryController::class, 'showCreateCategory']);
  Route::post('/create-category', [CategoryController::class, 'createCategory']);
  Route::delete('/delete-category/{id}', [CategoryController::class, 'deleteCategory']);
  Route::get('/update-category/{id}', [CategoryController::class, 'showUpdateCategory']);
  Route::put('/update-category/{id}', [CategoryController::class, 'updateCategory']);

  // User
  Route::get('/users', [UserController::class, 'index']);
  Route::get('/create-user', [UserController::class, 'showCreateUser']);
  Route::delete('/delete-user/{id}', [UserController::class, 'deleteUser']);
  Route::get('/update-user/{id}', [UserController::class, 'showUpdateUser']);

  // Profile
  Route::get('/profile/{username}', [UserController::class, 'showProfile']);

});

// Cart
Route::get('/add-cart/{id}', [ProductController::class, 'addCart']);
Route::get('/cart', [ProductController::class, 'showCart']);
Route::get('/remove-cart/{id}', [ProductController::class, 'removeCart']);
Route::get('/update-cart', [ProductController::class, 'updateCart']);


// Register user
Route::post('/create-user', [UserController::class, 'createUser']);

// Update user profile
Route::get('/update-user/{id}', [UserController::class, 'showUpdateUser']);
Route::put('/update-user/{id}', [UserController::class, 'updateUser']);


Route::get('/shop', [ShopController::class, 'index']);
Route::get('/profile/{username}', [UserController::class, 'showProfile']);

Route::get('/', [HomeController::class, 'index']);
Route::get('/test', [ShopController::class, 'testSesstionFunc']);


// Route::get('/test', function () {
//     return view('test');
// });