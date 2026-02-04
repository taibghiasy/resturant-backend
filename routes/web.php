<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ReservationController;
use App\Http\Controllers\Admin\TableController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\SignatureDishController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\Admin;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Profile Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Admin Routes (Protected)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', Admin::class])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard
        Route::get('/', [AdminController::class, 'index'])->name('index');

        /*
        |--------------------------------------------------------------------------
        | Categories, Menu, Tables, Reservation, Signature Dish
        |--------------------------------------------------------------------------
        */
        Route::resource('categories', CategoryController::class);
        Route::resource('menues', MenuController::class)->parameters(['menues' => 'menu']);
        Route::resource('tables', TableController::class);
        Route::resource('reservation', ReservationController::class);
        Route::resource('signature-dishes', SignatureDishController::class);

        /*
        |--------------------------------------------------------------------------
        | Orders Routes
        |--------------------------------------------------------------------------
        */

        // Pending Orders (main)
        Route::get('orders', [OrderController::class, 'index'])->name('orders.index');

        // Delivered Orders page
        Route::get('orders/delivered', [OrderController::class, 'delivered'])->name('orders.delivered');

        // Completed Orders page
        Route::get('orders/completed', [OrderController::class, 'completed'])->name('orders.completed');

        /*
        |-------------------
        | Print Routes
        |-------------------
        */
        Route::get('orders/print-all', [OrderController::class, 'printAll'])->name('orders.printAll');
        Route::get('orders/print-pending', [OrderController::class, 'printPending'])->name('orders.printPending');
        Route::get('orders/print-delivered', [OrderController::class, 'printDelivered'])->name('orders.printDelivered');
        Route::get('orders/print-completed', [OrderController::class, 'printCompleted'])->name('orders.printCompleted');
        Route::get('orders/{order}/print', [OrderController::class, 'print'])->name('orders.print');

        /*
        |-------------------
        | Clear Orders Routes (must be before parameter routes)
        |-------------------
        */
        Route::delete('orders/clear-all', [OrderController::class, 'clearAll'])->name('orders.clearAll');
        Route::delete('orders/clear-pending', [OrderController::class, 'clearPending'])->name('orders.clearPending');
        Route::delete('orders/clear-delivered', [OrderController::class, 'clearDelivered'])->name('orders.clearDelivered');
        Route::delete('orders/clear-completed', [OrderController::class, 'clearCompleted'])->name('orders.clearCompleted');

        /*
        |-------------------
        | Order CRUD / Status Update
        |-------------------
        */
        Route::patch('orders/{order}', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
        Route::delete('orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');
        Route::get('orders/{order}', [OrderController::class, 'show'])->name('orders.show');

    });

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
