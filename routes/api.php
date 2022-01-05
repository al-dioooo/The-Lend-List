<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// API
Route::get('item', [ApiController::class, 'item'])->name('api.item');
Route::get('borrower', [ApiController::class, 'borrower'])->name('api.borrower');

Route::get('report', [ApiController::class, 'report'])->name('api.report');

Route::get('year', [ApiController::class, 'year'])->name('api.year');
Route::get('month', [ApiController::class, 'month'])->name('api.month');
