<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use TCG\Voyager\Models\Role;

Route::get('/', function () {
    return view('welcome');
});
// главные страницы страница
Route::get('/home', [\App\Http\Controllers\ProductController::class, 'shopIndex'] )->name('home');
Route::get('/blog', [\App\Http\Controllers\ProductController::class, 'shopBlog'])->name('blog');
// создание рендинг страницы и вывод её фун-ий
Route::get('/shop', [\App\Http\Controllers\ProductController::class, 'shopList'])->name('shop');
Route::get('/checkout',[\App\Http\Controllers\ProductController::class, 'checkOut'])->name('checkout')->middleware('auth');
Route::get('/contact', function () {
    return view('shop/contact');
})->name('contact'); 
Route::get('/regular-page', function () {
    return view('shop/regular-page');
})->name('regular-page');
Route::get('/single-blog', function () {
    return view('shop/single-blog');
})->name('single-blog');

Route::get('/single-product-details', [\App\Http\Controllers\ProductController::class, 'productRetails'] )->name('productdetails');
// карзина для товаров
Route::get('/addcart/{id}', [\App\Http\Controllers\ProductController::class, 'addCart'])->name('addcart');
// удаление из корзины
Route::get('/removecart/{id}', [\App\Http\Controllers\ProductController::class, 'removeCart'])->name('removecart');
// выходим на эту страницу если зарегестрированы
Route::get('/account', [\App\Http\Controllers\ProductController::class, 'accIndex'])->name('account')->middleware('auth');
// отправка запроса на заказ
// Route::post('shop/makeorder', [\App\Http\Controllers\ProductController::class, 'makeOrder'])->name('makeorder')->middleware('auth');


Route::middleware('auth')->group( function(){
    Route::post('shop/makeorder', [\App\Http\Controllers\ProductController::class, 'makeOrder'])->name('makeorder');
    Route::get('shop/makeorder', [\App\Http\Controllers\ProductController::class, 'makeOrder'])->name('makeorder');
});



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
// group позволяется делать сразу групу действий
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
