<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;

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
Route::get('/', function () {
    return view('home'); // our Bootstrap Home page
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        Route::resource('posts', PostController::class);

});

require __DIR__.'/auth.php';


// Group routes that require authentication
Route::middleware(['auth'])->group(function () {

    // Show form to create a new post
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');

    // Store new post
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');

    // Show form to edit an existing post
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');

    // Update post
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');

    // Delete post
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
});
