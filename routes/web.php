<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\ApartmentController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\MessageController;
use App\Http\Controllers\User\ServiceController;
use App\Http\Controllers\User\SponsorshipController;
use App\Http\Controllers\User\ViewController;
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
    return view('auth.login');
});

/* Route::get('/dashboard', function () {
return view('user.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard'); */

Route::get('/front_office', [DashboardController::class, 'front_office'])->name('front_office');

Route::middleware(['auth', 'verified'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Route::resource('projects', ProjectController::class)->parameters(
    //     ['projects' => 'project:slug']
    // );
    Route::resource('apartments', ApartmentController::class)->parameters(
        ['apartments' => 'apartment:slug']
    );
    Route::resource('services', ServiceController::class);
    //Route::resource('messages', MessageController::class);
    // Route::resource('views', ViewController::class);
    Route::resource('sponsorships', SponsorshipController::class);
    Route::get('/payment', [SponsorshipController::class, 'payment'])->name('payment');
    Route::post('/transaction', [SponsorshipController::class, 'transaction'])->name('transaction');
    // Route::resource('messages', MessageController::class);
    Route::get('/messages/{slug}', [MessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/show/{message}', [MessageController::class, 'show'])->name('messages.show');
    Route::delete('/messages/{message}', [MessageController::class, 'destroy'])->name('messages.destroy');
    Route::get('/views/{slug}', [ViewController::class, 'index'])->name('views.index');
});

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__ . '/auth.php';
