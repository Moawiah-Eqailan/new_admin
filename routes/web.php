<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;



Route::get('/', function () {
    return redirect()->route('dashboard');
})->middleware('auth');

Route::controller(AuthController::class)->group(function () {
    Route::get('register', 'register')->name('register');
    Route::post('register', 'registerSave')->name('register.save');

    Route::get('login', 'login')->name('login');
    Route::post('login', 'loginAction')->name('login.action');

    Route::get('logout', 'logout')->middleware('auth')->name('logout');
});


// Protected Routes Group
Route::middleware('auth')->group(function () {
    Route::group(['middleware' => function ($request, $next) {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('home')->with('error', 'Access Denied.');
        }
        return $next($request);
    }], function () {
        // Protected routes
        Route::get('dashboard', function () {
            return view('dashboard');
        })->name('dashboard');

        Route::get('/dashboard', [AuthController::class, 'index'])->name('dashboard');

        // Product Routes
        Route::controller(ProductController::class)->prefix('products')->group(function () {
            Route::get('', 'index')->name('products');
            Route::get('create', 'create')->name('products.create');
            Route::post('store', 'store')->name('products.store');
            Route::get('show/{id}', 'show')->name('products.show');
            Route::get('edit/{id}', 'edit')->name('products.edit');
            Route::put('edit/{id}', 'update')->name('products.update');
            Route::delete('destroy/{id}', 'destroy')->name('products.destroy');
            Route::get('/search', 'search')->name('search');
        });

        // Category Routes
        Route::controller(CategoryController::class)->prefix('Categories')->group(function () {
            Route::get('', 'index')->name('Categories');
            Route::get('create', 'create')->name('Categories.create');
            Route::post('store', 'store')->name('Categories.store');
            Route::get('show/{id}', 'show')->name('Categories.show');
            Route::get('edit/{id}', 'edit')->name('Categories.edit');
            Route::put('edit/{id}', 'update')->name('Categories.update');
            Route::delete('destroy/{id}', 'destroy')->name('Categories.destroy');
            Route::get('/searchh', 'searchh')->name('searchh');
        });

        // Item Routes
        Route::controller(ItemController::class)->prefix('Items')->group(function () {
            Route::get('', 'index')->name('Items');
            Route::get('create', 'create')->name('Items.create');
            Route::post('store', 'store')->name('Items.store');
            Route::get('show/{id}', 'show')->name('Items.show');
            Route::get('edit/{id}', 'edit')->name('Items.edit');
            Route::put('edit/{id}', 'update')->name('Items.update');
            Route::delete('destroy/{id}', 'destroy')->name('Items.destroy');
            Route::get('/searrchh', 'searrchh')->name('searrchh');
        });

        // User Routes
        Route::controller(UserController::class)->prefix('Users')->group(function () {
            Route::get('', 'index')->name('Users');
            Route::get('create', 'create')->name('Users.create');
            Route::post('store', 'store')->name('Users.store');
            Route::get('show/{id}', 'show')->name('Users.show');
            Route::get('edit/{id}', 'edit')->name('Users.edit');
            Route::put('edit/{id}', 'update')->name('Users.update');
            Route::delete('destroy/{id}', 'destroy')->name('Users.destroy');
            Route::get('/ssearchh', 'ssearchh')->name('ssearchh');
        });

        // Profile Route
        Route::get('profile', [AuthController::class, 'profile'])->name('profile');
    });
});




Route::get('/welcome', function () {
    return view('welcome');
});



Route::get('/profile', function () {
    return view('UserProfile');
})->name('UserProfile');

Route::get('/editUserProfile', function () {
    return view('EditUserProfile');
})->name('EditUserProfile');

Route::post('/profile/update', [UserController::class, 'updateUserProfile'])->name('profile.update');



// home page Routes for users 
Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/get-products/{category_id}', [ProductController::class, 'getProductsByCategory']);
Route::get('/get-items/{product_id}', [ItemController::class, 'getItemsByProduct']);

Route::get('/find-parts', [HomeController::class, 'findParts']);


// Product Routes for users
Route::get('/product', [ProductController::class, 'view'])->name('product');

Route::get('/product/{category_id}', [ProductController::class, 'showProducts'])->name('product');

Route::get('/Item/{product_id}', [ItemController::class, 'showItem'])->name('Item');



Route::get('/detail/{id}', [ItemController::class, 'detail'])->name('Detail');
Route::get('/item/{id}', [ItemController::class, 'Item'])->name('Item');


Route::post('/favorites/toggle/{id}', [FavoriteController::class, 'toggle']);
Route::get('/favorites', [FavoriteController::class, 'index'])->name('Favorites');
Route::post('/favorites/{item_id}', [FavoriteController::class, 'addToCart'])->name('Favorites');


// Add item to cart
Route::post('/cart/{item_id}/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');
Route::POST('/cart/update/{cart_id}', [CartController::class, 'updateCart'])->name('cart.update');
Route::delete('/cart/remove/{cart_id}', [CartController::class, 'removeFromCart'])->name('cart.remove');


Route::post('/item/{item_id}', [CartController::class, 'addToCart'])->name('item');


// About
Route::get('/about', function () {
    return view('About');
})->name('about');



Route::get('/filter', [AuthController::class, 'findParts'])->name('filter');



