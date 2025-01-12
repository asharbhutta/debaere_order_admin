<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\OrderisCreated;
use App\Models\User;
use App\Models\Offering;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Mail\OrderEmail;
use App\Models\Promotion;
use App\Models\Product;
use App\Jobs\SendOrderEmailJob;


class OrderCreationListener
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
     * @param  object  $event
     * @return void
     */
    public function handle(OrderisCreated $event)
    {
        SendOrderEmailJob::dispatch($event->order);
        //
       // $this->sendOrderEmail($event->order);
    }

    
}
