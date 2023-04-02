<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\ItemController as AdminItemController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\Staff\AuctionController as StaffAuctionController;
use App\Http\Controllers\HomeController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/welcome', function () {
//     return view('welcome');
// });

// Route::get('/dash', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/auction/{id}', [FrontendController::class, 'detail'])->name('detail');

Route::middleware('auth')->group(function () {
    Route::get('/history', [HistoryController::class, 'index'])->name('history');
    Route::get('/about', [AboutController::class, 'index'])->name('about');
    Route::post('/auction/{id}', [FrontendController::class, 'bid']);
    Route::delete('/auction/{id}', [FrontendController::class, 'cancel_bid'])->name('cancel_bid');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::group([
        'prefix' => 'dashboard',
        'middleware' => 'CheckLevel:staff'
    ], function () {
        Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin');
        Route::resource('items', AdminItemController::class);
        Route::resource('auctions', StaffAuctionController::class);
        Route::post('/auctions/closeOpen/{id}', [StaffAuctionController::class, 'closeOpen'])->name('close-open');
        Route::get('/print-all-auctions', [StaffAuctionController::class, 'printAllAuctions'])->name('print-all-auctions');
        Route::get('/print-per-auction/{id}', [StaffAuctionController::class, 'printPerAuction'])->name('print-per-auction');
        Route::delete('/auctions/history/{id}', [StaffAuctionController::class, 'deleteHistory'])->name('auctions.deleteHistory');

        // Admin
        Route::resource('users', AdminUserController::class)->middleware(['CheckLevel:admin']);
    });
});

require __DIR__ . '/auth.php';
