<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderPlacedMail extends Mailable
{
    use Queueable, SerializesModels;

    public Order $order;

    public function __construct(Order $order)
    {
        // Ensure relations are loaded
        $this->order = $order->load('orderItems.item');
    }

    public function build()
    {
        return $this
            ->subject('Order Confirmation #' . $this->order->id)
            ->view('emails.orders.placed')
            ->with([
                'order' => $this->order,
            ]);
    }
}
