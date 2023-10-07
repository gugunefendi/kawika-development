<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\OngkirController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NotificationController;
use App\Models\OrderDetail;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\DiscountController;
use Dompdf\Dompdf;

Route::get('/', [FrontController::class, 'index'])->name('landing');
Route::get('/poduk/detail/{id}', [ProductController::class, 'detail'])->name('product.detail');
Route::get('/checkout/{id}', [OrderController::class, 'checkout'])->name('checkout');
Route::post('/order/store', [OrderController::class, 'store'])->name('order.store');
Route::get('/getCity/ajax/{id}', [OngkirController::class, 'ajax']);
Route::get('/ongkir', [OngkirController::class, 'index'])->name('ongkir');
Route::get('/chat', [OrderController::class, 'chat'])->name('chat');
Route::get('/terimakasih', [OrderController::class, 'thanks'])->name('thanks.page');
Route::post('/calculate-shipping', [OngkirController::class, 'calculateShipping'])->name('calculate.shipping');

Route::get('/send-notification', [NotificationController::class, 'sendOfferNotification']);
Route::post('/mark-notification-as-read', [NotificationController::class, 'markNotificationAsRead'])->name('mark-notification-as-read');

Route::get('/invoice/{id}/print', function ($id) {
    // Ambil data invoice berdasarkan ID
    $details = OrderDetail::find($id);

    // Buat objek Dompdf
    $dompdf = new Dompdf();

    // Render view ke dalam string HTML
    $html = view('admin.order.print', compact('details'))->render();

    // Muat string HTML ke dalam Dompdf
    $dompdf->loadHtml($html);

    // Render HTML menjadi PDF
    $dompdf->render();

    // Set nama file PDF yang akan diunduh
    $filename = 'invoice_' . $id . '.pdf';

    // Unduh file PDF
    return $dompdf->stream($filename);
});


Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->group(function(){

    Route::resource('setting', SettingController::class);

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.index');

    Route::get('/order-chart-data', [DashboardController::class, 'getData'])->name('order-chart.data');

    Route::controller(ProductController::class)->group(function () {
        Route::get('/product', 'index')->name('product.list');
        Route::get('/product/create', 'create')->name('product.create');
        Route::post('/product/store', 'store')->name('product.store');
        Route::get('/product/edit/{id}', 'edit')->name('product.edit');
        Route::put('/product/update/{id}', 'update')->name('product.update');
        Route::get('/poduct/destroy/{id}', 'destroy')->name('product.destroy');
    });

    Route::controller(CategoryController::class)->group(function () {
        Route::get('/category', 'index')->name('category.list');
        Route::get('/category/create', 'create')->name('category.create');
        Route::post('/category/store', 'store')->name('category.store');
        Route::get('/category/edit/{id}', 'edit')->name('category.edit');
        Route::post('/category/update/{id}', 'update')->name('category.update');
        Route::get('/category/delete/{id}', 'destroy')->name('category.destroy');
    });

    Route::controller(OrderController::class)->group(function () {
        Route::get('/order', 'index')->name('order.list');
        Route::get('/order/{id}', 'detail')->name('order.detail');
    });

    // Route::controller(DiscountController::class)->group(function () {
    //     Route::get('/discount', 'index')->name('discount.index');
    // });

    Route::controller(DiscountController::class)->group(function () {
        Route::get('/discount', 'index')->name('discount.index');
    });

    // Route::get('/diskon'. [DiscountController::class, 'index'])->name('discount.list');
});




