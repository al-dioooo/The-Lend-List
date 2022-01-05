<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\BorrowerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataListController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TrashController;
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

Route::get('', [DashboardController::class, 'index'])->name('index');

Route::resource('data-list', DataListController::class)->scoped([
    'data-list' => 'unique_id'
]);
Route::resource('item', ItemController::class);
Route::resource('borrower', BorrowerController::class);

Route::get('report', [ReportController::class, 'index'])->name('report.index');
Route::get('report/export', [ReportController::class, 'export'])->name('report.export');
Route::get('trash', [TrashController::class, 'index'])->name('trash.index');
Route::post('trash/restore', [TrashController::class, 'restore'])->name('trash.restore');
Route::delete('trash/destroy', [TrashController::class, 'destroy'])->name('trash.destroy');
Route::delete('trash/empty', [TrashController::class, 'empty'])->name('trash.empty');
