<?php

use Illuminate\Support\Facades\Route;

Route::get('/bugdget.blade.php', function () {
    return view('bugdget');
});
Route::get('/dashboard.blade.php', function () {
    return view('dashboard');
});
Route::get('/expense.blade.php', function () {
    return view('expense');
});
Route::get('/login.blade.php', function () {
    return view('login');
});
Route::get('/register.blade.php', function () {
    return view('register');
});
Route::get('/remind.blade.php', function () {
    return view('remind');
});
Route::get('/setting.blade.php', function () {
    return view('setting');
});
Route::get('/transaction.blade.php', function () {
    return view('transaction');
});