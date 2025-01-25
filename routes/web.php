<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
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
// Login Routes
Auth::routes();
// Include Admin Route
@include('admin.php');
// Include Students Route
@include('students.php');
// Login Socialite
Route::group(['as' => 'login.', 'prefix' => 'login', 'namespace' => 'Auth'], function () {
    Route::get('/{provider}', [LoginController::class, 'redirectToProvider'])->name('provider');
    Route::get('/{provider}/callback', [LoginController::class, 'handleProviderCallback'])->name('callback');
});
Route::get('/', function () {
    if(Auth::check() && Auth::user()->role->id == 1){
        return redirect()->route('admin.dashboard');
    }else if(Auth::check() && Auth::user()->role->id != 1) {
        return redirect()->route('student.dashboard');
    }else {
        return view('auth.login');
    }
});

