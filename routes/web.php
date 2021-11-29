<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\BorrowerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataListController;
use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('', [DashboardController::class, 'index'])->name('index');

Route::resource('data-list', DataListController::class);
Route::resource('item', ItemController::class);
Route::resource('borrower', BorrowerController::class);

// API
Route::get('api/item', [ApiController::class, 'item'])->name('api.item');
Route::get('api/borrower', [ApiController::class, 'borrower'])->name('api.borrower');

Route::get('api/uniqid', function () {
    return floor(time()-999999999);
});
