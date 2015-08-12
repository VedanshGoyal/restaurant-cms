<?php

namespace Restaurant\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener subscribe mappings for the application.
     *
     * @var array
     */
    protected $subscribe = [
        'Restaurant\Listeners\UserEventListener',
    ];
}
