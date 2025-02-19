<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AdminAuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DailyController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\STOController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\YourController;



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
    return view('login-admin');
})->name('login-admin');

Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Admin routes
Route::prefix('admin')->group(function () {
    Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [AdminAuthController::class, 'login'])->name('postlogin');
    Route::post('logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
});

Route::get('/Login-user', function () {
    return view('Login-user');
})->name('Login-user');

Route::post('/login-user', [UserController::class, 'login'])->name('loginUser');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('users', UserController::class);
Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
Route::get('/users/{user}/edit-password', [UserController::class, 'editPassword'])->name('users.editPassword');
Route::post('/users/{user}/update-password', [UserController::class, 'updatePassword'])->name('users.updatePassword');

Route::get('/reports/fg', [ReportController::class, 'index'])->name('reports.fg');
Route::get('/sto', [STOController::class, 'index'])->name('sto.index');
Route::get('/scan-sto', [InventoryController::class, 'showForm'])->name('scan-sto');

// Define the inventory routes
Route::resource('inventory', InventoryController::class);
Route::get('inventory/{inventory}/edit', [InventoryController::class, 'edit'])->name('inventory.edit');
Route::post('inventory/import', [InventoryController::class, 'import'])->name('inventory.import');
Route::get('inventory/upload', [InventoryController::class, 'showUploadForm'])->name('inventory.upload');
Route::post('inventory/upload', [InventoryController::class, 'upload'])->name('inventory.upload');
Route::post('/inventory/change_status/{id}', [InventoryController::class, 'changeStatus'])->name('inventory.change_status');
Route::post('inventory/{id}/change-status', [InventoryController::class, 'changeStatus'])->name('inventory.changeStatus');
Route::post('/inventory', [InventoryController::class, 'store'])->name('inventory.store');
Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory.index');
Route::post('/inventory/{id}/change-status', [InventoryController::class, 'changeStatus'])->name('inventory.changeStatus');
Route::get('/inventory/downloadPdf', [InventoryController::class, 'downloadPdf'])->name('inventory.downloadPdf');
Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
Route::post('/reports', [ReportController::class, 'index'])->name('reports.index');
Route::post('/reports', [ReportController::class, 'store'])->name('reports.store');

Route::get('/daily-stok', [DailyController::class, 'index'])->name('daily.index');
Route::get('/daily-stok/create', [DailyController::class, 'create'])->name('daily.create');
Route::post('/daily-stok', [DailyController::class, 'store'])->name('daily.store');
Route::get('/daily-stok/{id}/edit', [DailyController::class, 'edit'])->name('daily.edit');
Route::put('/daily-stok/{id}', [DailyController::class, 'update'])->name('daily.update');
Route::delete('/daily-stok/{id}', [DailyController::class, 'destroy'])->name('daily.destroy');
Route::post('/daily-stok/import', [DailyController::class, 'import'])->name('daily.import');

Route::resource('daily', DailyController::class);

Route::get('/form', [STOController::class, 'showForm'])->name('form');

Route::post('/scan-inventory', [InventoryController::class, 'scanInventory'])->name('scan.inventory');

Route::get('/sto-form/{inventory_id}', [InventoryController::class, 'showForm'])->name('sto.form');

// Route::post('/validasi', [YourController::class, 'validasi'])->name('validasi');

Route::get('/sto/index', [STOController::class, 'index'])->name('sto.index');
Route::get('/sto/form', [STOController::class, 'form'])->name('sto.form');
Route::get('/login', [STOController::class, 'showLoginForm'])->name('login'); // Contoh rute login

Route::post('/sto/report', [StoController::class, 'report'])->name('sto.report');