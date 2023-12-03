<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Models\Category;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ForgetPasswordManagerController;
use Illuminate\Support\Facades\Auth;
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

Route::prefix('admin')->middleware('role_name')->group(function () {
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
  Route::post('/create-user', [UserController::class, 'createUser']);
  Route::delete('/delete-user/{id}', [UserController::class, 'deleteUser']);
  Route::get('/update-user/{username}', [UserController::class, 'showAdminUpdateUser']);
  Route::put('/update-user/{username}', [UserController::class, 'updateUser']);

  // Profile
  Route::get('/profile/{username}', [UserController::class, 'showProfile']);

});

// Cart
Route::get('/add-cart/{id}', [ProductController::class, 'addCart']);
Route::get('/cart', [ProductController::class, 'showCart']);
Route::get('/remove-cart/{id}', [ProductController::class, 'removeCart']);
Route::get('/update-cart', [ProductController::class, 'updateCart']);

// Update user profile
Route::get('/update-user/{username}', [UserController::class, 'showUpdateUser']);
Route::put('/update-user/{username}', [UserController::class, 'updateUser']);


Route::get('/shop', [ShopController::class, 'index']);
Route::get('/profile/{username}', [UserController::class, 'showProfile']);

Route::get('/', [HomeController::class, 'index']);
Route::get('/test', [ShopController::class, 'testSesstionFunc']);


// Code của Nguyễn Châu Phúc Huy
Auth::routes();

// Login
Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'login'])->name('loginUser');

// Chuyển đến trang admin
Route::get('/admin/admin-profile', [LoginController::class, 'layout_admin'])->middleware('role_name');

// Chuyển đến trang user
Route::get('/user-profile', [LoginController::class, 'layout_user']);

// Register
Route::get('/register', [RegisterController::class, 'index']);
Route::post('/register', [RegisterController::class, 'register'])->name('registerUser');

// Logout
Route::get('/logout', [LoginController::class, 'logout']);

// Liên hệ
Route::get('/contact', [ContactController::class, 'index']);

// Reset password
Route::get('/forget-password', [ForgetPasswordManagerController::class, 'forgetPassword'])->name('forget.password');
Route::post('/forget-password', [ForgetPasswordManagerController::class, 'forgetPasswordPost'])->name('forget.password.post');
Route::get('/reset-password/{token}', [ForgetPasswordManagerController::class, 'resetPassword'])->name('reset.password');
Route::post('/reset-password', [ForgetPasswordManagerController::class, 'resetPasswordPost'])->name('reset.password.post');

// Route::get('/test', function () {
//     return view('test');
// });