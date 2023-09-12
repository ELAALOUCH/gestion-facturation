<?php

namespace App\Observers;

use App\Models\Order;
use App\Models\Product;

class OrderObserver
{
    /**
     * Handle the Product "created" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function created(Order $order): void
    {
        if($order->product_id){
            $product = Product::find($order->product_id);
            $product->stock-=$order->quantite;
            $product->save();
        }
    }

    /**
     * Handle the Order "updated" event.
     */
    public function updated(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "deleted" event.
     */
    public function deleted(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "restored" event.
     */
    public function restored(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "force deleted" event.
     */
    public function forceDeleted(Order $order): void
    {
        //
    }
}
