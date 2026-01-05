<?php

namespace App\Helpers\Cart;

use App\Models\Product;

class Cart
{

    // add product to cart
    public static function add2Cart(int $productId, int $quantity = 1): bool
    {
        $added = false;

        if (self::hasProductInCart($productId)) {
            session(["cart.{$productId}.quantity" => session("cart.{$productId}.quantity") + $quantity]);

            return true;
        }
        $product = Product::query()->find($productId);
        if ($product) {
            $new_product = [
                'title' => $product->title,
                'slug' => $product->slug,
                'image' => $product->image,
                'price' => $product->price,
                'quantity' => $quantity,
            ];
            session(["cart.{$productId}" => $new_product]);
            $added = true;
        }
        return $added;
    }

    // remove product from cart

    // get cart
    public static function getCart(): array
    {
        return session('cart') ?: [];
    }

    // clear cart

    // get cart total sum

    // get cart items

    // get cart quantity

    // has product in cart
    public static function hasProductInCart(int $productId): bool
    {
        return session()->has("cart.$productId");
    }

    // update item quantity

}
