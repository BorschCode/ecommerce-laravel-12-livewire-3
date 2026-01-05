<?php

namespace App\Helpers\Traits;

use App\Helpers\Cart\Cart;

trait CartTrait
{

    public int $quantity = 1;

    public function add2Cart(int $productId, $quantity = false)
    {
        $quantity = $quantity ? $this->quantity : 1;
        if ($quantity < 1) {
            $quantity = 1;
        }
        if (Cart::add2Cart($productId, $quantity)) {
            $this->js("toastr.success('Product added to cart successfully')");
            $this->dispatch('cart-updated');

            return;
        }

        $this->js("toastr.error('Oops! Something went wrong!')");
    }

}

/*

'cart' => [
    1 => [
        'title' => '',
        'slug' => '',
        'image' => '',
        'price' => '',
        'old_price' => '',
        'quantity' => 4,
    ],
    5 => [
        'title' => '',
        'slug' => '',
        'image' => '',
        'price' => '',
        'old_price' => '',
        'quantity' => 3,
    ],
]

 * */
