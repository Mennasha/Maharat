<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\WorkerController;
use App\Http\Controllers\ContactController;

// Install wizard routes (no auth, protected by CheckInstalled middleware in each route)
Route::prefix('install')->name('install.')->group(function () {
    Route::get('/', [App\Http\Controllers\InstallController::class, 'index'])->name('index');
    Route::get('/database', [App\Http\Controllers\InstallController::class, 'database'])->name('database');
    Route::post('/database/test', [App\Http\Controllers\InstallController::class, 'testDatabase'])->name('database.test');
    Route::post('/database', [App\Http\Controllers\InstallController::class, 'saveDatabase'])->name('database.save');
    Route::get('/app', [App\Http\Controllers\InstallController::class, 'app'])->name('app');
    Route::post('/app', [App\Http\Controllers\InstallController::class, 'saveApp'])->name('app.save');
    Route::get('/admin', [App\Http\Controllers\InstallController::class, 'admin'])->name('admin');
    Route::post('/admin', [App\Http\Controllers\InstallController::class, 'saveAdmin'])->name('admin.save');
    Route::get('/seed', [App\Http\Controllers\InstallController::class, 'seed'])->name('seed');
    Route::post('/run', [App\Http\Controllers\InstallController::class, 'run'])->name('run');
    Route::get('/success', [App\Http\Controllers\InstallController::class, 'success'])->name('success');
});

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

Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/about', function () {
    return view('pages.about');
})->name('about');

require __DIR__.'/auth.php';

Route::middleware(['auth'])->prefix('client')->name('client.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Client\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/orders/create', [App\Http\Controllers\Client\OrderController::class, 'create'])->name('orders.create');
    Route::post('/orders', [App\Http\Controllers\Client\OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/{order}', [App\Http\Controllers\Client\OrderController::class, 'show'])->name('orders.show');
});

Route::middleware(['auth','admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/workers', App\Http\Controllers\Admin\WorkerController::class);
    Route::resource('/orders', App\Http\Controllers\Admin\OrderController::class)->only(['index','show']);
    Route::post('/orders/{order}/update-status', [App\Http\Controllers\Admin\OrderController::class, 'updateStatus'])->name('orders.update-status');
    Route::resource('/testimonials', App\Http\Controllers\Admin\TestimonialController::class)->except(['show']);
    Route::resource('/partners', App\Http\Controllers\Admin\PartnerController::class)->except(['show']);
    Route::resource('/faqs', App\Http\Controllers\Admin\FaqController::class)->except(['show']);
    Route::resource('/services', App\Http\Controllers\Admin\ServiceController::class)->except(['show']);
    Route::resource('/prices', App\Http\Controllers\Admin\NationalityPriceController::class)->except(['show']);
    Route::get('/settings', [App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');
    Route::get('/contact-requests', function () {
        $requests = \App\Models\ContactRequest::latest()->paginate(20);
        return view('admin.contact_requests.index', compact('requests'));
    })->name('contact-requests.index');
    Route::post('/contact-requests/{id}/read', function ($id) {
        \App\Models\ContactRequest::findOrFail($id)->update(['is_read' => true]);
        return back()->with('success', 'تم تحديد الرسالة كمقروءة');
    })->name('contact-requests.read');
});
