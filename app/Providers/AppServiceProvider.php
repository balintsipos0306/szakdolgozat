<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Cart;
use App\Models\Webshop;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Share cart data with cart-modal component and webshop-header
        View::composer(['components.cart-modal', 'components.webshop-header'], function ($view) {
            if (auth()->check()) {
                $cartItems = Cart::where('userID', auth()->id())
                    ->with('item') // Eager load the webshop item to prevent N+1 queries
                    ->get();
                
                $hasItems = $cartItems->isNotEmpty();
                $cartSum = $cartItems->sum(function($cart) {
                    return $cart->item->price ?? 0;
                });
                
                $view->with([
                    'cartItems' => $cartItems,
                    'hasItems' => $hasItems,
                    'cartSum' => $cartSum
                ]);
            } else {
                $view->with([
                    'cartItems' => collect(),
                    'hasItems' => false,
                    'cartSum' => 0
                ]);
            }
        });
    }
}
