<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\AdminGamesController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\ProfileSettingController;


//Admin Routes
Route::group(['as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('profile', [ProfileSettingController::class, 'profile'])->name('profile');
    Route::put('profile-update', [ProfileSettingController::class, 'profileUpdate'])->name('profile.update');
    Route::get('change-password', [ProfileSettingController::class, 'changePassword'])->name('change.password');
    Route::put('password-update', [ProfileSettingController::class, 'updatePassword'])->name('password.update');
    Route::get('dashboard',[AdminDashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('user',[AdminDashboardController::class, 'user'])->name('user');
    Route::post('user-approve/{id}',[AdminDashboardController::class, 'userApprove'])->name('user.approve');
    Route::get('create-user',[AdminDashboardController::class, 'createUser'])->name('create.user');
    Route::get('create-role',[AdminDashboardController::class, 'roleCreate'])->name('create.role');
    Route::get('role',[AdminDashboardController::class, 'role'])->name('role');


    Route::get('game-list',[AdminGamesController::class, 'indexGame'])->name('game-list');
    Route::get('create-game',[AdminGamesController::class, 'createGame'])->name('create-game');
    Route::post('store-game',[AdminGamesController::class, 'storeGame'])->name('store-game');
    Route::get('edit-game/{id}',[AdminGamesController::class, 'editGame'])->name('edit-game');
    Route::put('update-game/{id}',[AdminGamesController::class, 'updateGame'])->name('update-game');
    Route::delete('delete-game/{id}',[AdminGamesController::class, 'deleteGame'])->name('delete-game');
    Route::delete('user-delete/{id}',[AdminDashboardController::class, 'userDelete'])->name('user-delete');
});

// Setting Routes
Route::group(['as' => 'admin.setting.', 'prefix' => 'admin/setting'], function(){
    Route::get('generel', [SettingController::class, 'generel'])->name('generel');
    Route::put('generel-update', [SettingController::class, 'generelUpdate'])->name('generel.update');
    Route::put('appearance-update', [SettingController::class, 'appearanceUpdate'])->name('appearance.update');
    Route::put('mail-update', [SettingController::class, 'mailUpdate'])->name('mail.update');
});
