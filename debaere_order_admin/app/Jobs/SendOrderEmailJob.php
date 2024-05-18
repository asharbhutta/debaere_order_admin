<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use App\Models\Offering;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Mail\OrderEmail;
use App\Models\Promotion;
use App\Models\Product;


class SendOrderEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $order;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($order)
    {
        $this->order=$order;
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $this->sendOrderEmail($this->order);
    }

    public function sendOrderEmail($order)
    {
        $orderEmails=[];
       // $orderEmails[]="asharbhutta@gmail.com";
        
        if($order->customer->user->email!="bhuttaashar@gmail.com")
        {
          //  $orderEmails[]="kaleembhutta@debaere.co.uk";
          //  $orderEmails[]="orders@debaere.co.uk";

        }
        
        \Mail::to($order->customer->user->email)->send(new OrderEmail($order));
        $order->confirm_order=true;
        
        //$orderEmails[]=$order->customer->user->email;
        \Mail::to($orderEmails)->send(new OrderEmail($order));
    }
}
