<?php

use App\Http\Controllers\PortfolioController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [PortfolioController::class, 'home'])->name('home');

Route::get('/about', [PortfolioController::class, 'about'])->name('about');
Route::get('/resume', [PortfolioController::class, 'resume'])->name('resume');
Route::get('/service', [PortfolioController::class, 'service'])->name('service');
Route::get('/contact', [PortfolioController::class, 'contact'])->name('contact');
Route::get('/portfolio', [PortfolioController::class, 'portfolio'])->name('portfolio');
Route::get('/portfolio_details/{id}', [PortfolioController::class, 'details'])->name('portfolio.details');

