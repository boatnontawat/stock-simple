<?php

use App\Http\Controllers\StockItemController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/stock-items');

Route::post('stock-items/{stock_item}/use', [StockItemController::class, 'recordUsage'])->name('stock-items.use');
Route::resource('stock-items', StockItemController::class);

// ถ้าต้องการจำกัดให้ต้อง login ก่อนใช้งาน ให้ครอบด้วย middleware('auth') เช่น:
// Route::middleware('auth')->group(function () {
//     Route::resource('stock-items', StockItemController::class);
// });
