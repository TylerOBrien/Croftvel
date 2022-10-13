<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class MakeRequests extends Command
{
    protected $signature = 'make:croft-requests {name} {--abilities=index,show,store,update,destroy}';
    protected $description = 'Create multiple requests.';

    /**
     * @return void
     */
    public function handle()
    {
        $name = trim($this->argument('name'));
        $abilities = trim($this->option('abilities'));

        foreach (explode(',', $abilities) as $ability) {
            Artisan::call('make:croft-request', ['name' => $name, '--ability' => $ability]);
        }
    }
}
