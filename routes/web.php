<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

use App\Http\Controllers\AdminController;

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

/* Route::get('/', function () {
    return view('welcome');
}); */

route::get('/', [HomeController::class, 'index']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

route::get('/redirect', [HomeController::class, 'redirect']);

route::get('/all_products', [HomeController::class, 'all_products']);

route::get('/view_category', [AdminController::class, 'view_category']);

route::post('/add_category', [AdminController::class, 'add_category']);

route::get('/delete_category/{id}', [AdminController::class, 'delete_category']);

route::get('/view_product', [AdminController::class, 'view_product']);

route::post('/add_product', [AdminController::class, 'add_product']);

route::get('/show_product', [AdminController::class, 'show_product']);

route::get('/delete_product/{id}', [AdminController::class, 'delete_product']);

route::get('/edit_product/{id}', [AdminController::class, 'edit_product']);

route::post('/edit_product_save/{id}', [AdminController::class, 'edit_product_save']);

route::get('/show_product', [AdminController::class, 'show_product']);

route::get('/order', [AdminController::class, 'order']);

route::get('/actioned/{id}', [AdminController::class, 'actioned']);

route::get('/print_pdf/{id}', [AdminController::class, 'print_pdf']);

route::get('/search', [AdminController::class, 'search_order']);


/* Home/Customer routes */

route::get('/product_details/{id}', [HomeController::class, 'product_details']);

route::post('/add_cart/{id}', [HomeController::class, 'add_cart']);

route::get('/remove_item/{id}', [HomeController::class, 'remove_item']);

route::get('/cancel_order/{id}', [HomeController::class, 'cancel_order']);

route::get('/show_cart', [HomeController::class, 'show_cart']);

route::get('/show_order', [HomeController::class, 'show_order']);

route::get('/cash_order', [HomeController::class, 'cash_order']);

route::get('/stripe/{total_price}', [HomeController::class, 'stripe']);

Route::post('stripe/{total_price}', [HomeController::class, 'stripePost'])->name('stripe.post');

route::get('/search_product', [HomeController::class, 'search_product']);

route::post('/add_comment', [HomeController::class, 'add_comment']);

route::post('/add_reply', [HomeController::class, 'add_reply']);

route::get('/coming_soon', [HomeController::class, 'coming_soon']);