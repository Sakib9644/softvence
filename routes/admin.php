<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Backend\MainCategoryController;
use App\Http\Controllers\Backend\PermissionController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\RoleControllerr;
use App\Http\Controllers\Backend\WebsitesetupController;
use App\Http\Controllers\ProfileController;
use App\Models\Websitesetup;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Contracts\Permission;

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/backend/edit', [WebsitesetupController::class, 'edit'])->name('backend.edit');
    Route::post('/backend/update', [WebsitesetupController::class, 'update'])->name('websitesetup.update');
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('main-category', MainCategoryController::class);

    Route::post('/store/permission', [PermissionController::class, 'store'])->name('permissions.store');

    Route::get('/create/permission', [PermissionController::class, 'create'])->name('permissions.create');

    Route::get('/create/permission', [PermissionController::class, 'index'])->name('permissions.index');

    Route::put('/permissions/{id}', [PermissionController::class, 'update'])->name('permissions.update');

    Route::delete('permissions/{id}', [PermissionController::class, 'destroy'])->name('permissions.destroy');

    Route::post('/user/store', [RegisteredUserController::class, 'admin_user'])->name('user.store');

    Route::get('/create/user', [RegisteredUserController::class, 'admin_create'])->name('users.create');

    Route::put('user/{id}', [RegisteredUserController::class, 'update'])->name('user.update');
    Route::delete('user/{id}', [RegisteredUserController::class, 'destroy'])->name('user.destroy');


    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
    Route::get('/roles/{id}', [RoleController::class, 'permission'])->name('find.permissions');
    Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
    Route::post('/roles/assign-permissions', [RoleController::class, 'assignPermissions'])->name('roles.assign.permissions');
});
