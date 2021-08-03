<?php

namespace App\Providers;

use App\Models\Lainya;
use App\Models\Suket;
use App\Models\Legalisir;
use App\Observers\SuratObserver;
use App\Observers\LainnyaObserver;
use App\Observers\LegalisirObserver;
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
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Legalisir::observe(LegalisirObserver::class);
        Suket::observe(SuratObserver::class);
        Lainya::observe(LainnyaObserver::class);
    }
}
