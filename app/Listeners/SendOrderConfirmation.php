<?php

namespace App\Listeners;

use App\Events\OrderPlaced;
use App\Mail\OrderConfirmation;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class SendOrderConfirmation
{
    public function handle(OrderPlaced $event)
    {
        try {
            // Send to customer
            Mail::to($event->order->user->email)
                ->queue(new OrderConfirmation($event->order, false));
        } catch (\Exception $e) {
            Log::error('Failed to send order confirmation to customer: ' . $e->getMessage(), [
                'order_id' => $event->order->id,
                'user_email' => $event->order->user->email
            ]);
        }

        try {
            // Send to admin
            Mail::to(('	
nlangworth@example.org'))
                ->queue(new OrderConfirmation($event->order, true));	
        } catch (\Exception $e) {
            Log::error('Failed to send order confirmation to admin: ' . $e->getMessage(), [
                'order_id' => $event->order->id,
                'admin_email' => config('mail.admin_address')
            ]);
        }
    }
}