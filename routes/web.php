<?php

use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
});

//Prueba de Hola mundo
use App\Http\Controllers\Prueba\HolaMundoController;

Route::get('/hola-mundo', [HolaMundoController::class, 'index']);

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\UsersImportController;

Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminController::class, 'loginForm'])->name('admin.login');
    Route::post('/login', [AdminController::class, 'login'])->name('admin.login.submit');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard')->middleware('auth:admin');
    Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');
// CRUD de usuarios
Route::resource('users', UsersController::class)->names('admin.users');
// Importar usuarios desde Excel
Route::get('/importar-usuarios', [UsersImportController::class, 'show'])->name('admin.importar-usuarios.show');
Route::post('/importar-usuarios', [UsersImportController::class, 'import'])->name('admin.importar-usuarios');
});


//Rutas de usuarios
use App\Http\Controllers\User\UserController;

Route::prefix('user')->group(function () {
    Route::get('/register', [UserController::class, 'registerForm'])->name('user.register');
    Route::post('/register', [UserController::class, 'register'])->name('user.register.submit');
    Route::get('/login', [UserController::class, 'loginForm'])->name('user.login');
    Route::post('/login', [UserController::class, 'login'])->name('user.login.submit');
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard')->middleware('auth');
    Route::post('/logout', [UserController::class, 'logout'])->name('user.logout');
});



