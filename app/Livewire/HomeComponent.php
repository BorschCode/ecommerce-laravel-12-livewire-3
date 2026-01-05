<?php

namespace App\Livewire;

use App\Models\Product;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class HomeComponent extends Component
{
    public function render(): View
    {
        $hits_products = Product::whereIsHit(true)->orderBy('id', 'desc')->limit(4)->get();
        $new_products = Product::whereIsNew(true)->orderBy('id', 'desc')->limit(8)->get();
        return view('livewire.home-component', [
            'hits_products' => $hits_products,
            'new_products' => $new_products
        ]);
    }
}
