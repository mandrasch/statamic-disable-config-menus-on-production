<?php

namespace Mandrasch\DisableConfigMenusOnProduction;

use Mandrasch\DisableConfigMenusOnProduction\Middleware\CheckIfLocal;

use Statamic\Providers\AddonServiceProvider;

use Statamic\Facades\CP\Nav;

class ServiceProvider extends AddonServiceProvider
{

    // https://statamic.dev/extending/addons#middleware
    protected $middlewareGroups = [
        'statamic.cp.authenticated' => [
            CheckIfLocal::class
        ]
    ];

    public function bootAddon()
    {
        if (!strpos(env('APP_URL'), '.ddev.site')) {

            // Remove menu items on production/live
            // https://statamic.dev/extending/navigation#removing-items
            Nav::extend(function ($nav) {
                // remove complete section
                $nav->remove('Fields');
                // remove subpage
                $nav->remove('Tools', 'Updates');
                $nav->remove('Tools', 'Addons');
            });
        }
    }
}
