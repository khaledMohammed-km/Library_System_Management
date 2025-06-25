<?php
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::middleware(['guest'])->group(function () {
  Route::get('/', [AdminAuthController::class, 'showLoginForm'])->name('login');
  Route::post('/', [AdminAuthController::class, 'login']);
  Route::get('/users-creation',[UserController::class,'showRegistrationForm'])->name('registration');


  Route::post('/users-creation', [UserController::class, 'testAddUser']);
  Route::post('/manage-users/update/{key}', [UserController::class, 'update_user'])->name('photos.update_user');
  Route::post('/manage-users/delete/{key}', [UserController::class, 'delete_user'])->name('photos.delete_user');
  Route::get('/manage-users/edit/{key}', [UserController::class, 'edit_user'])->name('photos.edit_user');
});
