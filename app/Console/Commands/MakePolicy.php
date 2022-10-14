<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;

class MakePolicy extends GeneratorCommand
{
    protected $signature = 'make:croft-policy {name} {--owned} {--apiversion=1}';
    protected $description = 'Create a policy.';

    /**
     * @return string
     */
    protected function buildClass($name)
    {
        $name = trim($this->argument('name'));
        $path = '';
        $subdir_pivot = strpos($name, '/');

        if ($subdir_pivot !== false) {
            $path = substr($name, 0, $subdir_pivot);
            $name = substr($name, strrpos($name, '/') + 1);
        }

        $replace = [];

        $replace['DummyPolicy'] = $this->getPolicyName();
        $replace['DummyModel'] = $name;
        $replace['DummyPath'] = config('models.namespace') . $path;
        $replace['DummyBinding'] = Str::snake($name);
        $replace['DummyPluralBinding'] = Str::snake(Str::plural($name));
        $replace['DummyBindingId'] = Str::snake($name) . '_id';

        // If there is no subdir given then remove the '\' character at the
        // end to prevent '\\' from being written.

        if (! $this->hasSubDirectory()) {
            $replace['DummyPath'] = substr($replace['DummyPath'], 0, -1);
        }

        return str_replace(
            array_keys($replace), array_values($replace), parent::buildClass($name)
        );
    }

    /**
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return "$rootNamespace\Policies\Api\\v{$this->option('apiversion')}";
    }

    /**
     * @return string
     */
    protected function getPath($name)
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name) . '.php';
        $name = str_replace(
            "{$this->argument('name')}.php", "{$this->getPolicyName()}.php", $name
        );

        return $this->laravel['path'].'/'.str_replace('\\', '/', $name);
    }

    /**
     * @return string
     */
    protected function getPolicyName()
    {
        $name = str_replace('Policy', '', trim($this->argument('name')));
        $pivot = strrpos($name, '/');

        if ($pivot !== false) {
            $name = substr($name, $pivot + 1);
        }

        return $name . 'Policy';
    }

    /**
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . '/stubs/policies/' . ($this->option('owned') ? 'policy-owned.stub' : 'policy.stub');
    }

    /**
     * @return string
     */
    protected function hasSubDirectory()
    {
        return strpos($this->argument('name'), '/') !== false;
    }
}
