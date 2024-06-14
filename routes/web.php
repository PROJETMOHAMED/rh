<?php

use App\Http\Controllers\Admin\AuthController;
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

Route::permanentRedirect('/', '/admin');

Route::controller(AuthController::class)->group(function(){
    Route::get('login' , "LoginForm")->name('login');
    Route::post('login' , "login")->name('login.fun');
    Route::post('logout' , "logout")->name('logout');
});


require __DIR__ . '/admin.php';