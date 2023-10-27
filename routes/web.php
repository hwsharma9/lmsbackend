<?php

use App\Http\Controllers\Auth\LoginController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::prefix('/manage')->name('manage.')->group(function () {
    Route::get('/login', [LoginController::class, 'showAdminLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'adminLogin'])->name('login');
});


require __DIR__ . '/admin_auth.php';
