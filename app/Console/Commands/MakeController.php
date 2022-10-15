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
     * Execute the console command.
     *
     * @return bool|null
     */
    public function handle(): bool|null
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

        return parent::handle();
    }

    /**
     * Build the fully qualified class name for the controller.
     *
     * @param  string  $name
     *
     * @return string
     */
    protected function buildClass($name): string
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
            array_keys($replace),
            array_values($replace),
            parent::buildClass($name),
        );
    }

    /**
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace . '\Http\Controllers\Api\v1\\' . ucfirst(trim($this->option('type')));
    }

    /**
     * @return string
     */
    protected function getPath($name): string
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name) . '.php';
        $name = str_replace(
            "{$this->argument('name')}.php", "{$this->getControllerName()}.php", $name
        );

        return $this->laravel['path'].'/'.str_replace('\\', '/', $name);
    }

    /**
     * @return string
     */
    protected function getControllerName(): string
    {
        return str_replace('Controller', '', trim($this->argument('name'))) . 'Controller';
    }

    /**
     * @return string
     */
    protected function getStub(): string
    {
        return __DIR__ . '/stubs/controllers/controller.stub';
    }
}
