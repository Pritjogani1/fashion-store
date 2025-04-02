<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Events\UserRegistered;
use App\Events\OrderPlaced;
use App\Listeners\SendWelcomeEmail;
use App\Listeners\SendOrderConfirmation;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        UserRegistered::class => [
            SendWelcomeEmail::class,
        ],
        OrderPlaced::class => [
            SendOrderConfirmation::class,
        ],
    ];

    public function boot()
    {
        parent::boot();
    }
}