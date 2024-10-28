<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Permissions Route

    Route::get('/permission',[PermissionController::class,'index'])->name('permissions.index');
    Route::get('/permissions/create',[PermissionController::class,'create'])->name('permissions.create');
    Route::post('/permissions',[PermissionController::class,'store'])->name('permissions.store');

    Route::get('/permissions/edit/{id}',[PermissionController::class,'edit'])->name('permissions.edit');
    Route::post('/permissions/edit/{id}',[PermissionController::class,'update'])->name('permissions.update');

    Route::delete('/permissions',[PermissionController::class,'destroy'])->name('permissions.delete');


    // Roles Route

    Route::get('/roles',[RoleController::class,'index'])->name('roles.index');
    Route::get('/roles/create',[RoleController::class,'create'])->name('roles.create');
    Route::post('/roles',[RoleController::class,'store'])->name('roles.store');
    Route::get('/roles/edit/{id}',[RoleController::class,'edit'])->name('roles.edit');
    Route::post('/roles/edit/{id}',[RoleController::class,'update'])->name('roles.update');
    Route::delete('/roles/delete',[RoleController::class,'destroy'])->name('roles.destroy');


    // Articles Route

    Route::get('/articles',[ArticleController::class,'index'])->name('articles.index');
    Route::get('/articles/create',[ArticleController::class,'create'])->name('articles.create');
    Route::post('/articles',[ArticleController::class,'store'])->name('articles.store');
    Route::get('/articles/edit/{id}',[ArticleController::class,'edit'])->name('articles.edit');
    Route::post('/articles/edit/{id}',[ArticleController::class,'update'])->name('articles.update');
    Route::delete('/articles/delete',[ArticleController::class,'destroy'])->name('articles.destroy');


    // Users Route

    Route::get('/users',[UserController::class,'index'])->name('users.index');
    Route::get('/users/create',[UserController::class,'create'])->name('users.create');
    Route::post('/users',[UserController::class,'store'])->name('users.store');
    Route::get('/users/edit/{id}',[UserController::class,'edit'])->name('users.edit');
    Route::post('/users/edit/{id}',[UserController::class,'update'])->name('users.update');
    Route::delete('/users/delete',[UserController::class,'destroy'])->name('users.destroy');

});

require __DIR__.'/auth.php';
