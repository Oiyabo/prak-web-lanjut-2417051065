<?php

use App\Http\Controllers\ProfileController;

Route::get('/profile/{nama}/{npm}/{kelas}', [ProfileController::class, 'profile']);