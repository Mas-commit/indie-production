<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('items')->group(function () {
    Route::get('/', [App\Http\Controllers\ItemController::class, 'index']);
    Route::get('/add', [App\Http\Controllers\ItemController::class, 'add']);
    Route::post('/add', [App\Http\Controllers\ItemController::class, 'add']);
    Route::get('/edit/{id}',[App\Http\Controllers\ItemController::class, 'itemEdit']);
    Route::post('/editor',[App\Http\Controllers\ItemController::class,'itemEditor']);
    Route::get('/qtyedit/{id}', [App\Http\Controllers\ItemController::class, 'qtyEdit']);
    Route::post('/qtyedit', [App\Http\Controllers\ItemController::class, 'qtyEdit']);
    Route::get('/detail/{id}',[App\Http\Controllers\ItemController::class, 'detail']);
    Route::post('/imagedelete',[App\Http\Controllers\ItemController::class,'itemImageDestroyer']);
    Route::post('/itemdelete',[App\Http\Controllers\ItemController::class,'itemDestroyer']);
});
Route::get('/search', [ItemController::class, 'search']);

Route::get('/notification/{id}',[App\Http\Controllers\HomeController::class, 'notificationEdit']);
Route::post('/notification/editor',[App\Http\Controllers\HomeController::class,'notificationEditor']);
Route::get('/notificationadd', [App\Http\Controllers\HomeController::class, 'notificationAdd']);
Route::post('/notificationadd', [App\Http\Controllers\HomeController::class, 'notificationAdd']);