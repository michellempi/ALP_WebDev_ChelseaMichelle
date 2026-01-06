<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\AddressBookController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\ShippingMethodController;
use App\Http\Controllers\VariantController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('users.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
        Route::resource('categories', CategoryController::class);
        Route::resource('products', ProductController::class);
        Route::resource('variants', VariantController::class);
        Route::resource('payment-methods', PaymentMethodController::class);
        Route::resource('shipping-methods', ShippingMethodController::class);
        Route::resource('promos', PromoController::class);

        Route::get('orders', [AdminOrderController::class, 'index'])->name('orders.index');
        Route::get('orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
        Route::post('orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.update-status')->where('order', '[0-9]+');
    });

    Route::middleware('auth')->group(function () {
        Route::get('/catalogue', function () {
            $products = \App\Models\Product::with(['category', 'variants'])->get();
            $activePromos = \App\Models\Promo::active()->get();

            foreach ($products as $product) {
                foreach ($product->variants as $variant) {
                    $variant->original_price = $variant->price;
                    $variant->discounted_price = $variant->price;
                    $variant->active_promo = null;

                    foreach ($activePromos as $promo) {
                        $discountAmount = $variant->price * ($promo->discount / 100);
                        $newPrice = $variant->price - $discountAmount;

                        if ($newPrice < $variant->discounted_price) {
                            $variant->discounted_price = $newPrice;
                            $variant->active_promo = $promo;
                        }
                    }
                }
            }

            return view('users.catalogue.index', compact('products', 'activePromos'));
        })->name('catalogue.index');

        Route::resource('carts', CartController::class)->parameters([
            'carts' => 'cart:cart_id',
        ]);

        Route::resource('address-books', AddressBookController::class)->parameters([
            'address-books' => 'addressBook:address_id',
        ]);

        Route::resource('orders', OrderController::class)->parameters([
            'orders' => 'order:order_id',
        ]);
    });
});

require __DIR__.'/auth.php';
