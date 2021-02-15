<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;

use Laravel\Telescope\{ IncomingEntry, Telescope, TelescopeApplicationServiceProvider };

class TelescopeServiceProvider extends TelescopeApplicationServiceProvider
{
    /**
     * Bootstrap services.
     * 
     * @return void
     */
    public function boot()
    {
        Telescope::auth(function ($request) {
            return app()->environment('local') ||
                   Gate::check('telescope', [ auth('croft')->parseToken($request) ]);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->hideSensitiveRequestDetails();

        Telescope::filter(function (IncomingEntry $entry) {
            if ($this->app->environment('local')) {
                return true;
            }

            return $entry->isReportableException() ||
                   $entry->isFailedRequest() ||
                   $entry->isFailedJob() ||
                   $entry->isScheduledTask() ||
                   $entry->hasMonitoredTag();
        });
    }

    /**
     * Prevent sensitive request details from being logged by Telescope.
     *
     * @return void
     */
    protected function hideSensitiveRequestDetails()
    {
        if ($this->app->environment('local')) {
            return;
        }

        Telescope::hideRequestParameters(['_token']);
        Telescope::hideRequestHeaders([
            'cookie',
            'x-csrf-token',
            'x-xsrf-token',
        ]);
    }
}
