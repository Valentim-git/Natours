<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SpotController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SlotController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Auth;

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
    return view('welcome1');
});


Auth::routes(['verify' => true]);

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('admin/home', [HomeController::class, 'adminHome'])->name('admin.home')->middleware('UserAdmin');

Route::post('save', [SpotController::class, 'store'])->name('upload.spot');

Route::get('/generate-pdf/{spot}', [PDFController::class, 'generatePDF'])->name('generate.pdf');


//Route::resource('users', UserController::class)->middleware('UserAdmin');
Route::get('/users', [UserController::class, 'index'])->middleware('UserAdmin');
Route::post('/users', [UserController::class, 'store'])->middleware('UserAdmin');
Route::get('/users/show/{user}', [UserController::class, 'show'])->middleware('UserAdmin');
Route::get('/users/edit/{user}', [UserController::class, 'edit'])->middleware('UserAdmin');
Route::post('/users/update/{user}', [UserController::class, 'update'])->middleware('UserAdmin');
Route::delete('/users/destroy/{user}', [UserController::class, 'destroy'])->middleware('UserAdmin');

Route::get('/spots', [SpotController::class, 'index'])->middleware('UserAdmin');
Route::post('/spots', [SpotController::class, 'store'])->middleware('UserAdmin');
Route::get('/spots/show/{spot}', [SpotController::class, 'show']); //->middleware('UserAdmin');
Route::get('/spots/edit/{spot}', [SpotController::class, 'edit'])->middleware('UserAdmin');
Route::post('/spots/update/{spot}', [SpotController::class, 'update'])->middleware('UserAdmin');
Route::delete('/spots/destroy/{spot}', [SpotController::class, 'destroy'])->middleware('UserAdmin');
Route::get('/search', [SpotController::class, 'searchByCity'])->name('spot.search');



//Route::get('/', 'App\Http\Controllers\SpotController@checkout')->name('checkout');
// web.php
Route::post('/session/{spot}', [SpotController::class, 'session'])->name('checkout.session');
Route::get('/success', [SpotController::class, 'success'])->name('success');

Route::post('/favorites/add/{spot}', [FavoriteController::class, 'add'])->name('favorites.add');
Route::delete('/favorites/remove/{spot}', [FavoriteController::class, 'remove'])->name('favorites.remove');

Route::post('/spots/{spot}/comments', [CommentController::class, 'store'])->name('comments.store');
//Route::post('/session/{slot}', [SlotController::class, 'session'])->name('checkout.session');
//Route::get('/success', [SlotController::class, 'success'])->name('success');
