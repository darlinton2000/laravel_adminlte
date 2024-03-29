<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\RegisterController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Site\SiteController;
use Illuminate\Support\Facades\Auth;
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

// Site inicial
Route::get('/', [SiteController::class, 'index'])->name('home');

// Autenticação
Auth::routes();

Route::prefix('painel')->group(function () {
    // Administrativo
   Route::get('/', [AdminController::class, 'index'])->name('admin');

   // Login
    Route::get('login', [LoginController::class, 'index'])->name('login');
    Route::post('login', [LoginController::class, 'authenticated']);
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    // Cadastro
    Route::get('register', [RegisterController::class, 'index'])->name('register');
    Route::post('register', [RegisterController::class, 'register']);

    // Usuário
    Route::resource('users', UserController::class);

    // Perfil
    Route::get('profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('profile/save', [ProfileController::class, 'save'])->name('profile.save');
});
