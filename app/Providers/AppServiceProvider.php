<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        \Event::listen(BuildingMenu::class, function (BuildingMenu $event) {
        $pendientes = \App\Models\Pago::where('status', 'pendiente')->count();
        $event->menu->addAfter('main_navigation', [
            'type'         => 'navbar-notification',
            'id'           => 'my-notification',
            'icon'         => 'fas fa-bell',
            'label'        => $pendientes,
            'label_color'  => 'danger',
            'url'          => 'admin/pagos',
            'topnav_right' => true, // Esto lo pone al lado de la campanita
        ]);
    });
    }
}
