<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::get('/', function () {
    return view('user');
});

Route::post('user', [UserController::class, 'store']);
Route::get('/viewall', [UserController::class, 'index']);

// Route::view('view', 'user');
Route::resource('/usermodel', 'UserController');
Route::get('edit-user/{id}', [UserController::class, 'edit']);
Route::put('update', [UserController::class, 'update']);
Route::delete('delete', [UserController::class, 'delete']);
