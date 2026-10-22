<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MealController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Models\Category;
use App\Models\Meal;

Route::get('/', function () {
    $categories = Category::all();
    $meals = Meal::with('category')->latest()->get();
    return view('welcome', compact('categories', 'meals'));
})->name('home');

Route::prefix('admin')->middleware(['auth', 'verified'])->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    Route::resource('categories', CategoryController::class);
    Route::resource('meals', MealController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
