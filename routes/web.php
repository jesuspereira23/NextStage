<?php

use Illuminate\Support\Facades\Route;

Route::get('/', fn() => view('index'));

Route::get('/login',    fn() => view('auth.login'))->name('login');
Route::get('/register', fn() => view('auth.register'))->name('register');
Route::get('/profile', fn() => view('profile.index'))->name('profile.index');

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
Route::get('/workouts',       fn() => view('workouts.index'))->name('workouts.index');
Route::get('/exercises',       fn() => view('exercises.index'))->name('exercises.index');
Route::get('/objectives',     fn() => view('objectives.index'))->name('objectives.index');
Route::get('/guias',     fn() => view('guias.index'))->name('guias.index');
Route::get('/evolution-logs', fn() => view('evolution-logs.index'))->name('evolution-logs.index');
