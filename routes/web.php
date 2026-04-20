<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\WorkerController;

Route::get('/', [LandingController::class, 'index'])->name('home');
Route::get('/workers', [WorkerController::class, 'index'])->name('workers.index');
Route::get('/workers/{worker}', [WorkerController::class, 'show'])->name('workers.show');

Route::get('/services', function () {
    $services = \App\Models\Service::where('is_active', true)->get();
    return view('pages.services', compact('services'));
})->name('services');

Route::get('/prices', function () {
    $prices = \App\Models\NationalityPrice::where('is_active', true)->get();
    return view('pages.prices', compact('prices'));
})->name('prices');

Route::get('/faq', function () {
    $faqs = \App\Models\Faq::where('is_active', true)->orderBy('order')->get();
    return view('pages.faq', compact('faqs'));
})->name('faq');

require __DIR__.'/auth.php';

Route::middleware(['auth'])->prefix('client')->name('client.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Client\DashboardController::class, 'index'])->name('dashboard');
});

Route::middleware(['auth','admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/workers', App\Http\Controllers\Admin\WorkerController::class);
    Route::resource('/orders', App\Http\Controllers\Admin\OrderController::class)->only(['index','show']);
    Route::post('/orders/{order}/update-status', [App\Http\Controllers\Admin\OrderController::class, 'updateStatus'])->name('orders.update-status');
});
