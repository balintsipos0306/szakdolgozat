<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class webshopHeader extends Component
{
    public $hasCartItems;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->hasCartItems = false;
        
        if (Auth::check()) {
            $this->hasCartItems = Cart::where('userID', Auth::id())->exists();
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.webshop-header');
    }
}
