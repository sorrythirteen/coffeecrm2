<?php

use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// Контроллеры CRM 1
use App\Http\Controllers\Customer1Controller;
use App\Http\Controllers\Menu1Controller;
use App\Http\Controllers\Order1Controller;
use App\Http\Controllers\OrderItem1Controller;
use App\Http\Controllers\Transaction1Controller;

// Контроллеры CRM 2
use App\Http\Controllers\Customer2Controller;
use App\Http\Controllers\Employee2Controller;
use App\Http\Controllers\Menu2Controller;
use App\Http\Controllers\Inventory2Controller;
use App\Http\Controllers\Order2Controller;
use App\Http\Controllers\OrderItem2Controller;
use App\Http\Controllers\Transaction2Controller;
use App\Http\Controllers\WorkHour2Controller;

// Контроллеры CRM 3
use App\Http\Controllers\Customer3Controller;
use App\Http\Controllers\Employee3Controller;
use App\Http\Controllers\Menu3Controller;
use App\Http\Controllers\Inventory3Controller;
use App\Http\Controllers\Order3Controller;
use App\Http\Controllers\OrderItem3Controller;
use App\Http\Controllers\Transaction3Controller;
use App\Http\Controllers\WorkHour3Controller;
use App\Http\Controllers\LoyaltyProgram3Controller;
use App\Http\Controllers\CustomerLoyalty3Controller;
use App\Http\Controllers\LoyaltyTransaction3Controller;

// Главная страница — выбор CRM
Route::get('/', function () {
    return view('select_crm');
})->name('home');

// Обработка выбора CRM
Route::post('/select-crm', function (Request $request) {
    $crm = $request->input('crm'); 
    session(['selected_crm' => $crm]);
    return redirect()->route('crm' . $crm . '.dashboard');
})->name('select.crm.submit');


// CRM 1 маршруты
Route::prefix('crm1')->name('crm1.')->group(function () {
    Route::get('/dashboard', function () {
        return view('crm1.dashboard');
    })->name('dashboard');

    Route::resource('customers', Customer1Controller::class);
    Route::resource('menu', Menu1Controller::class);
    Route::resource('orders', Order1Controller::class);
    Route::resource('order-items', OrderItem1Controller::class);
    Route::resource('transactions', Transaction1Controller::class);
});

// CRM 2 маршруты
Route::prefix('crm2')->name('crm2.')->group(function () {
    Route::get('/dashboard', function () {
        return view('crm2.dashboard');
    })->name('dashboard');

    Route::resource('customers', Customer2Controller::class);
    Route::resource('employees', Employee2Controller::class);
    Route::resource('menu', Menu2Controller::class);
    Route::patch('/crm1/menu/{menu}/update-status', [Menu1Controller::class, 'updateStatus'])->name('crm1.menu.update-status');
    Route::resource('inventory', Inventory2Controller::class);
    Route::resource('orders', Order2Controller::class);
    Route::resource('order-items', OrderItem2Controller::class);
    Route::resource('transactions', Transaction2Controller::class);
    Route::resource('workhours', WorkHour2Controller::class);
    
});

// CRM 3 маршруты
Route::prefix('crm3')->name('crm3.')->group(function () {
    Route::get('/dashboard', function () {
        return view('crm3.dashboard');
    })->name('dashboard');

    Route::resource('customers', Customer3Controller::class);
    Route::resource('employees', Employee3Controller::class);
    Route::resource('menu', Menu3Controller::class);
    Route::resource('inventory', Inventory3Controller::class);
    Route::resource('orders', Order3Controller::class);
    Route::resource('order-items', OrderItem3Controller::class);
    Route::resource('transactions', Transaction3Controller::class);
    Route::resource('workhours', WorkHour3Controller::class);
    Route::resource('loyalty-programs', LoyaltyProgram3Controller::class);
    Route::resource('reviews', ReviewController::class);
});
