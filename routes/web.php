<?php
use App\Http\Controllers\AdminAuthController;
use Illuminate\Support\Facades\Route;


Route::middleware(['guest'])->group(function () {
  Route::get('/', [AdminAuthController::class, 'showLoginForm'])->name('login');
  Route::post('/', [AdminAuthController::class, 'login']);
});
