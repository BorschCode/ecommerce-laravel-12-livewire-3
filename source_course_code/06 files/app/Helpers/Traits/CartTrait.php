<?php

namespace App\Helpers\Traits;

trait CartTrait
{

    public int $quantity = 1;

    public function add2Cart(int $productId, $quantity = false)
    {
        dump($productId);
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
