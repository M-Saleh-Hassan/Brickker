<?php

namespace App\Listeners;

use App\Events\ProductCreation;
use App\Models\Scale;

class SendProductNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\ProductCreation  $event
     * @return void
     */
    public function handle(ProductCreation $event)
    {
        // Access the order using $event->product...
        $product = $event->product;
        
        $scale = new Scale;
        $scale->title = $product->title;
        $scale->description = $product->short_description;
        $scale->media_id = 25;
        $scale->save();
    }
}
