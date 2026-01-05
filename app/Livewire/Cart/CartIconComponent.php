<?php

namespace App\Livewire\Cart;

use Livewire\Attributes\On;
use Livewire\Component;

class CartIconComponent extends Component
{

//    #[On(CartTrait::EVENT_NAME)]
    #[On('cart-updated')]
    public function render()
    {
        return view('livewire.cart.cart-icon-component');
    }
}
