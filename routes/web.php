<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\Calculator;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', fn() => view('welcome'))->name('counter');
Route::get('/counter', fn() => view('welcome'))->name('counter');
Route::get('/calculator', fn() => view('calculator'))->name('calculator');
Route::get('/todo-list', fn() => view('todo-list'))->name('todo-list');
Route::get('/cascading-dropdown', fn() => view('cascading-dropdown'))->name('cascading-dropdown');
Route::get('/products', fn() => view('products'))->name('products');
Route::get('/image-upload', fn() => view('image-upload'))->name('image-upload');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
