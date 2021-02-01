<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class MakeRequests extends Command
{
    protected $signature = 'make:croft-requests {name} {--ability=}';
    protected $description = 'Create multiple requests.';

    /**
     * 
     */
    public function handle()
    {
        $name = trim($this->argument('name'));
        
        foreach (explode(',', $this->option('ability')) as $ability) {
            Artisan::call('make:croft-request', ['name' => $name, '--ability' => $ability]);
        }
    }
}
