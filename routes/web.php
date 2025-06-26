<?php
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::middleware(['guest'])->group(function () {
  Route::get('/', [AdminAuthController::class, 'showLoginForm'])->name('login');
  Route::post('/', [AdminAuthController::class, 'login']);
  Route::get('/users-creation',[UserController::class,'showRegistrationForm'])->name('registration');
  Route::post('/users', [UserController::class, 'userStore'])->name('users.store');
  Route::get('/users/update/', [UserController::class, 'showEditForm'])->name('edit');
  //Route::post('/manage-users/delete/{key}', [UserController::class, 'delete_user'])->name('photos.delete_user');
  //Route::get('/users/edit/{key}', [UserController::class, 'edit_user'])->name('photos.edit_user');
});
