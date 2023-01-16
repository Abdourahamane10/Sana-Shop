<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\ProductController;

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

/*Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});*/

Route::get('/', [ClientController::class, 'home']);
Route::get('/shop', [ClientController::class, 'shop']);
Route::get('panier', [ClientController::class, 'panier']);
Route::get('/paiement', [ClientController::class, 'paiement']);
Route::get('/login', [ClientController::class, 'login']);
Route::get('/signup', [ClientController::class, 'signup']);


Route::get('/admin', [AdminController::class, 'dashboard']);


Route::get('/addCategory', [CategoryController::class, 'addCategory']);
Route::get('/categories', [CategoryController::class, 'categories']);


Route::get('/addSlider', [SliderController::class, 'addSlider']);
Route::get('/sliders', [SliderController::class, 'sliders']);


Route::get('/addProduct', [ProductController::class, 'addProduct']);
Route::get('/products', [ProductController::class, 'products']);

//require __DIR__ . '/auth.php';
