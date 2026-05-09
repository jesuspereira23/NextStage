<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

Route::get('/', fn() => view('index'));

Route::get('/login',    fn() => view('auth.login'))->name('login');
Route::get('/register', fn() => view('auth.register'))->name('register');
Route::get('/profile',  fn() => view('profile.index'))->name('profile.index');
Route::post('/logout',  [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

// Rotas com nomes alterados para evitar conflito com a API (.page)
Route::get('/workouts',       fn() => view('workouts.index'))->name('workouts.page');
Route::get('/exercises',      fn() => view('exercises.index'))->name('exercises.page');
Route::get('/objectives',     fn() => view('objectives.index'))->name('objectives.page');
Route::get('/evolution-logs', fn() => view('evolution-logs.index'))->name('evolution-logs.page');

// Esta rota não conflita, mas você pode manter o padrão se quiser
Route::get('/guias',          fn() => view('guias.index'))->name('guias.index');
