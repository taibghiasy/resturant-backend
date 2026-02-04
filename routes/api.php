<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// API Controllers
use App\Http\Controllers\Api\CategoryApiController;
use App\Http\Controllers\Api\MenuApiController;
use App\Http\Controllers\Api\TableApiController;
use App\Http\Controllers\Api\ReservationApiController;
use App\Http\Controllers\Api\SignatureDishApiController;

// Admin Controllers
use App\Http\Controllers\Admin\OrderController as AdminOrderController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application.
|
*/

// ------------------------
// Public Test Routes


Route::get('/admin/orders/unseen-count', [AdminOrderController::class, 'unseenCount']);
Route::post('/admin/orders/mark-seen', [AdminOrderController::class, 'markAllSeen']);

// ------------------------
Route::get('debug', function() {
    return [
        'routes_loaded' => true,
        'php_version' => phpversion(),
        'laravel_version' => app()->version(),
    ];
});

Route::get('test', function () {
    return ['message' => 'API works!'];
});

// ------------------------
// Orders (Customer) - Public
// ------------------------
Route::post('/orders', [AdminOrderController::class, 'store']); // place an order

// ------------------------
// Admin Orders (Protected / optional middleware later)
// ------------------------
Route::prefix('admin')->group(function () {
    Route::get('/orders', [AdminOrderController::class, 'index']); // view all orders
    Route::get('/orders/{order}', [AdminOrderController::class, 'show']); // view single order
    Route::patch('/orders/{order}', [AdminOrderController::class, 'updateStatus']); // update order status
    Route::delete('/orders/{order}', [AdminOrderController::class, 'destroy']); // delete order
});

// ------------------------
// API v1 - Public CRUD Routes
// ------------------------
Route::prefix('v1')->group(function () {

    // Categories
    Route::get('categories', [CategoryApiController::class, 'index']);
    Route::get('categories/{category}', [CategoryApiController::class, 'show']);
    Route::post('categories', [CategoryApiController::class, 'store']);
    Route::put('categories/{category}', [CategoryApiController::class, 'update']);
    Route::delete('categories/{category}', [CategoryApiController::class, 'destroy']);

    // Menus
    Route::get('menus', [MenuApiController::class, 'index']);
    Route::get('menus/{menu}', [MenuApiController::class, 'show']);
    Route::post('menus', [MenuApiController::class, 'store']);
    Route::put('menus/{menu}', [MenuApiController::class, 'update']);
    Route::delete('menus/{menu}', [MenuApiController::class, 'destroy']);

    // Tables
    Route::get('tables', [TableApiController::class, 'index']);
    Route::get('tables/{table}', [TableApiController::class, 'show']);
    Route::post('tables', [TableApiController::class, 'store']);
    Route::put('tables/{table}', [TableApiController::class, 'update']);
    Route::delete('tables/{table}', [TableApiController::class, 'destroy']);

    // Reservations
    Route::get('reservations', [ReservationApiController::class, 'index']);
    Route::get('reservations/{reservation}', [ReservationApiController::class, 'show']);
    Route::post('reservations', [ReservationApiController::class, 'store']);
    Route::put('reservations/{reservation}', [ReservationApiController::class, 'update']);
    Route::delete('reservations/{reservation}', [ReservationApiController::class, 'destroy']);

    // Signature Dishes
    Route::get('signature-dishes', [SignatureDishApiController::class, 'index']);
    Route::get('signature-dishes/{signatureDish}', [SignatureDishApiController::class, 'show']);
});
