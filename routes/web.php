<?php

use App\Http\Controllers\Admin\ActivityController as AdminActivityController;
use App\Http\Controllers\Admin\RedeemController as AdminRedeemController;
use App\Http\Controllers\Admin\RewardController as AdminRewardController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Member\ActivityController as MemberActivityController;
use App\Http\Controllers\Member\RedeemController as MemberRedeemController;
use App\Http\Controllers\Member\RewardController as MemberRewardController;
use App\Http\Controllers\Member\UserController as MemberUserController;
use App\Models\Role;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware(['role:'.Role::ADMIN])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->middleware(['auth'])->name('dashboard');

    Route::resource('activities', AdminActivityController::class)->only([
        //
    ]);

    Route::resource('redeems', AdminRedeemController::class);

    Route::resource('rewards', AdminRewardController::class);

    Route::resource('users', AdminUserController::class)->only([
        'index', 'show'
    ]);
});

Route::middleware(['role:'.Role::MEMBER])->prefix('member')->name('member.')->group(function () {

    Route::get('/dashboard', function () {
        return view('member.dashboard');
    })->middleware(['auth'])->name('dashboard');

    Route::resource('activities', MemberActivityController::class)->only([
        'index', 'show', 'edit', 'update'
    ]);

    Route::resource('redeems', MemberRedeemController::class)->only([
        'index', 'store'
    ]);

    Route::resource('rewards', MemberRewardController::class)->only([
        'index'
    ]);

    Route::resource('users', MemberUserController::class)->only([
        //
    ]);
});

require __DIR__.'/auth.php';
