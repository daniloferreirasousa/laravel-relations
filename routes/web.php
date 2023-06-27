<?php

use Illuminate\Support\Facades\Route;
use App\Models\{
    User,
    Preference
}

Route::get('/one-to-one', function () {
    $user = User::first();

    dd($user);
});

Route::get('/', function () {
    return view('welcome');
});
