<?php

namespace App\Livewire\Cart;

use App\Mail\OrderClient;
use App\Mail\OrderManager;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class CheckoutComponent extends Component
{

    public string $name;
    public string $email;
    public string $note;

    public function mount()
    {
        $this->name = auth()->user()->name ?? '';
        $this->email = auth()->user()->email ?? '';
    }

    public function saveOrder()
    {
        $validated = $this->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'note' => 'string|nullable',
        ]);
        $validated = array_merge($validated, [
            'user_id' => auth()->id(),
            'total' => \App\Helpers\Cart\Cart::getCartTotal()
        ]);

        try {
            DB::beginTransaction();
            $order = Order::query()->create($validated);
            $order_products = [];
            $cart = \App\Helpers\Cart\Cart::getCart();
            foreach ($cart as $product_id => $product) {
                $order_products[] = [
                    'product_id' => $product_id,
                    'title' => $product['title'],
                    'price' => $product['price'],
                    'quantity' => $product['quantity'],
                    'slug' => $product['slug'],
                    'image' => $product['image'],
                ];
            }
            $order->orderProducts()->createMany($order_products);

            DB::commit();

            try {
                Mail::to($validated['email'])->send(new OrderClient($order_products, \App\Helpers\Cart\Cart::getCartTotal(), $order->id, $validated['note']));
                Mail::to('manager@laravel-eshop.loc')->send(new OrderManager($order->id));
            } catch (\Exception $e) {
                Log::error($e->getMessage());
            }

            \App\Helpers\Cart\Cart::clearCart();
            $this->dispatch('cart-updated');
            $this->js("toastr.success('Success ordering!')");
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            $this->js("toastr.error('Error ordering!')");
        }
    }

    public function render()
    {
        return view('livewire.cart.checkout-component', [
            'title' => 'Checkout'
        ]);
    }
}
