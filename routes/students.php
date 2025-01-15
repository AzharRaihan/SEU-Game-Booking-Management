<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Students\StudentDashboardController;


//Student Or Author Routes
Route::group(['as' => 'student.', 'prefix' => 'student', 'namespace' => 'Students', 'middleware' => ['auth', 'student']], function () {
    Route::get('dashboard', [StudentDashboardController::class, 'dashboard'])->name('dashboard');
    Route::put('book-game/{id}', [StudentDashboardController::class, 'bookGame'])->name('book-game');
});
