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
Route::get('/panier', [ClientController::class, 'panier']);
Route::get('/paiement', [ClientController::class, 'paiement']);
Route::get('/login', [ClientController::class, 'login']);
Route::get('/signup', [ClientController::class, 'signup']);
Route::get('/orders', [ClientController::class, 'orders']);
Route::get('/ajouterAuPanier/{id}', [ClientController::class, 'ajouterAuPanier']);
Route::post('/modifierQuantite/{id}', [ClientController::class, 'modifierQuantite']);
Route::get('/supprimerDuPanier/{id}', [ClientController::class, 'supprimerDuPanier']);
Route::post('/creerCompte', [ClientController::class, 'creerCompte']);
Route::post('/accederCompte', [ClientController::class, 'accederCompte']);
Route::get('/logout', [ClientController::class, 'logout']);
Route::post('/payer', [ClientController::class, 'payer']);


Route::get('/admin', [AdminController::class, 'dashboard']);


Route::get('/addCategory', [CategoryController::class, 'addCategory']);
Route::get('/categories', [CategoryController::class, 'categories']);
Route::post('/saveCategory', [CategoryController::class, 'saveCategory']);
Route::get('/editCategory/{id}', [CategoryController::class, 'editCategory']);
Route::post('/updateCategory', [CategoryController::class, 'updateCategory']);
Route::get('/deleteCategory/{id}', [CategoryController::class, 'deleteCategory']);



Route::get('/addSlider', [SliderController::class, 'addSlider']);
Route::get('/sliders', [SliderController::class, 'sliders']);
Route::post('/saveSlider', [SliderController::class, 'saveSlider']);
Route::get('/editSlider/{id}', [SliderController::class, 'editSlider']);
Route::post('/updateSlider', [SliderController::class, 'updateSlider']);
Route::get('/activerSlider/{id}', [SliderController::class, 'activerSlider']);
Route::get('/desactiverSlider/{id}', [SliderController::class, 'desactiverSlider']);
Route::get('/deleteSlider/{id}', [SliderController::class, 'deleteSlider']);


Route::get('/addProduct', [ProductController::class, 'addProduct']);
Route::get('/products', [ProductController::class, 'products']);
Route::post('/saveProduct', [ProductController::class, 'saveProduct']);
Route::get('/editProduct/{id}', [ProductController::class, 'editProduct']);
Route::post('/updateProduct', [ProductController::class, 'updateProduct']);
Route::get('/deleteProduct/{id}', [ProductController::class, 'deleteProduct']);
Route::get('/activerProduct/{id}', [ProductController::class, 'activerProduct']);
Route::get('/desactiverProduct/{id}', [ProductController::class, 'desactiverProduct']);
Route::get('/selectParCat/{category_name}', [ProductController::class, 'selectParCat']);

//require __DIR__ . '/auth.php';
