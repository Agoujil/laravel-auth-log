<?php
namespace Agodev\LaravelAuthLog;

use Illuminate\Support\Facades\Event;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;


class AuthLogServiceProvider extends ServiceProvider
{
    
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */

    protected $listen = [
        'Illuminate\Auth\Events\Login' => [
            'Agodev\LaravelAuthLog\Listeners\LoginListener',
        ],
        'Illuminate\Auth\Events\Logout' => [
            'Agodev\LaravelAuthLog\Listeners\LogoutListener',
        ],
    ];


    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../migrations' => database_path('migrations'),
            ], 'Laravel AuthLog migrations');

        }


    }

 
}