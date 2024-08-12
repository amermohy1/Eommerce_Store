<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\Dashboard\ProductsController;
use App\Http\Controllers\Dashboard\ProfileController;


Route::group([

    'middleware' => ['auth'],
    // 'as' =>'dashboard',
    // 'prefix' => 'dashboard',
],function(){
    Route::get('profile',[ProfileController::class,'edit'])->name('profile.edit');
    Route::patch('profile',[ProfileController::class,'update'])->name('profile.update');

    Route::get('/dashboard',[DashboardController::class,'index'])
    ->name('dashboard');

    Route::get('/categories/trash',[CategoriesController::class,'trash'])
    ->name('categories.trash');

    Route::put('/categories/{cateogry}/restore',[CategoriesController::class,'restore'])
    ->name('categories.restore');

    Route::delete('/categories/{cateogry}/force_delete',[CategoriesController::class,'forceDelete'])
    ->name('categories.force_delete');
    
    Route::resource('dashboard/categories',CategoriesController::class);
    Route::resource('dashboard/products',ProductsController::class);

});



