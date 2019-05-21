<?php

namespace BahatiSACCO\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        'BahatiSACCO\Events\MemberCreated' => [
            'BahatiSACCO\Listeners\CreatePasswordReset',
        ],

        'BahatiSACCO\Events\ConductorCreated' => [
            'BahatiSACCO\Listeners\CreatePasswordReset',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
