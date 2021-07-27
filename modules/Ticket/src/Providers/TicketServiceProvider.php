<?php


namespace Ticket\Providers;


use Ticket\Observers\ReplyObserver;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Ticket\Models\Reply;
use Ticket\Models\Ticket;
use Ticket\Policies\ReplyPolicy;
use Ticket\Policies\TicketPolicy;

class TicketServiceProvider extends ServiceProvider
{
    public function register()
    {
//        Reply::observe(ReplyObserver::class);
        Gate::policy(Ticket::class, TicketPolicy::class);
        Gate::policy(Reply::class, ReplyPolicy::class);
    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/ticket_routes.php');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
//        $this->loadFactoriesFrom(__DIR__ . '/../database/factories');
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'Ticket');
    }
}
