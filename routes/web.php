<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;

Route::get('/profile/{nama}/{npm}/{kelas}', [ProfileController::class, 'profile']);
Route::get('/user/create', [UserController::class, 'create']) -> name('user.create');
Route::post('/user', [UserController::class, 'store']) -> name('user.store');