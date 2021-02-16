<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Artisan;

class MakeController extends GeneratorCommand
{
    protected $signature = 'make:croft-controller {name} {--type=} {--requests} {--policies}';
    protected $description = 'Create a controller.';

    /**
     * 
     */
    public function handle()
    {
        $name = trim($this->argument('name'));

        if ($this->option('policies')) {
            Artisan::call('make:croft-policy', [ 'name' => $name ]);
        }

        if ($this->option('requests')) {
            Artisan::call('make:croft-request', ['name' => $name, '--ability' => 'index']);
            Artisan::call('make:croft-request', ['name' => $name, '--ability' => 'show']);
            Artisan::call('make:croft-request', ['name' => $name, '--ability' => 'store']);
            Artisan::call('make:croft-request', ['name' => $name, '--ability' => 'update']);
            Artisan::call('make:croft-request', ['name' => $name, '--ability' => 'destroy']);
        }

        parent::handle();
    }

    /**
     * 
     */
    protected function buildClass($name)
    {
        $name = trim($this->argument('name'));
        $replace = [];

        $replace['DummyApiNamespace'] = ucfirst($this->option('type'));
        $replace['DummyController'] = $this->getControllerName();
        $replace['DummyModel'] = $name;
        $replace['DummyBinding'] = Str::snake($name);
        $replace['DummyPluralBinding'] = Str::snake(Str::plural($name));
        $replace['DummyBindingId'] = Str::snake($name) . '_id';

        return str_replace(
            array_keys($replace), array_values($replace), parent::buildClass($name)
        );
    }

    /**
     * 
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Http\Controllers\Api\v1\\' . ucfirst(trim($this->option('type')));
    }

    /**
     * 
     */
    protected function getPath($name)
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name) . '.php';
        $name = str_replace(
            "{$this->argument('name')}.php", "{$this->getControllerName()}.php", $name
        );

        return $this->laravel['path'].'/'.str_replace('\\', '/', $name);
    }

    /**
     * 
     */
    protected function getControllerName()
    {
        return str_replace('Controller', '', trim($this->argument('name'))) . 'Controller';
    }

    /**
     * 
     */
    protected function getStub()
    {
        return __DIR__ . '/stubs/controllers/controller.stub';
    }
}
