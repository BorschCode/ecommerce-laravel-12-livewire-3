<?php

namespace App\Livewire\Cart;

use App\Helpers\Traits\CartTrait;
use Livewire\Component;

class CartModalComponent extends Component
{
    use CartTrait;

    public function render()
    {
        return view('livewire.cart.cart-modal-component');
    }
}
