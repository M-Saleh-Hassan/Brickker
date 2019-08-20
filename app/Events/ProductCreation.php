<?php

namespace App\Events;

use App\Models\Product;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ProductCreation implements ShouldBroadcast
{
    use SerializesModels;

    public $product;

    /**
     * Create a new event instance.
     *
     * @param  \App\Product  $product
     * @return void
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }
}
