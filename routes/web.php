<?php
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;


Route::middleware(['guest'])->group(function () {
  Route::get('/', [AdminAuthController::class, 'showLoginForm'])->name('login');
  Route::post('/', [AdminAuthController::class, 'login']);
  Route::get('/users-creation',[UserController::class,'showRegistrationForm'])->name('users.create');
  Route::post('/users', [UserController::class, 'userStore'])->name('users.store');
  //Route::post('/manage-users/delete/{key}', [UserController::class, 'delete_user'])->name('photos.delete_user');
  //Route::get('/users/edit/{key}', [UserController::class, 'edit_user'])->name('photos.edit_user');
});
  Route::get('/users/update/', [UserController::class, 'showEditForm'])->name('edit');

// Books views
Route::get('/index', [BookController::class, 'booksDashboard'])->name('books.index');
Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');
Route::get('/books/{book}/edit', [BookController::class, 'edit'])->name('books.edit');
Route::put('/books/{book}', [BookController::class, 'update'])->name('books.update');
Route::delete('/books/{book}', [BookController::class, 'destroy'])->name('books.destroy');


// Categories views
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');

// Users views
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users-creation', [UserController::class, 'showRegistrationForm'])->name('registration');
Route::get('/users/update', [UserController::class, 'showEditForm'])->name('edit');


Route::middleware(['auth'])->group(function () {
    Route::post('/books', [BookController::class, 'store'])->name('books.store');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::post('/cart/add/{book}', [CartController::class, 'add'])->name('cart.add'); 
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::delete('/cart/remove/{cart}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
});
