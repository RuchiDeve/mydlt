<?php

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
    return redirect('/app/dashboard');
});

Route::get('/install', function () {
    echo \Artisan::call('migrate:fresh', ['--seed' => true]);

    echo \Artisan::call('view:clear');
    echo \Artisan::call('view:cache');
    echo \Artisan::call('storage:link');

    return 'installed';
});


Route::prefix('app')->name('app.')->middleware('auth')->group(function (){
    Route::view('dashboard', 'app.dashboard')->name('dashboard');
    Route::view('sms', 'app.sms')->name('sms');
    Route::view('settings', 'app.settings')->name('settings');
    Route::view('members', 'app.members')->name('members');


    Route::post('sms/purchase', [
        \App\Http\Controllers\SmsPurchaseController::class,
        'purchaseSms'
    ])->name('sms.purchase');

    Route::get('pay', [
        \App\Http\Controllers\DashboardController::class,
        'webhook'
    ])->name('webhook');


    Route::view('domain', 'app.domain')->name('domain');
    Route::view('enquiries', 'app.enquiries')->name('enquiries');


    Route::post('domain/purchase', [
        \App\Http\Controllers\DomainPurchaseController::class,
        'purchaseDomain'
    ])->name('domain.purchase');


    Route::get('logout', function(){
        auth()->logout();

        return back();
    });
});


Route::prefix('domain')->name('domain.')->middleware(['domain.validate'])->group(function (){

    Route::view('{member}', 'domains.member-page')->name('page');

});
