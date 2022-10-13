<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;

class MakeRequest extends GeneratorCommand
{
    protected $signature = 'make:croft-request {name} {--ability=} {--apiversion=1}';
    protected $description = 'Create requests.';

    /**
     * @return string
     */
    protected function buildClass($name)
    {
        $name = $this->getNameArgument();
        $replace = [];

        $replace['DummyBinding'] = Str::snake($name);
        $replace['DummyRequest'] = $this->getRequestName();
        $replace['DummyModel'] = $name;
        $replace['DummyPath'] = config('croft.models.namespace') . $this->getSubDirectory();

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
        return "$rootNamespace\Http\Requests\Api\\v{$this->option('apiversion')}\\{$this->getNameArgument()}";
    }

    /**
     * @return string
     */
    protected function getPath($className)
    {
        if ($this->hasSubDirectory()) {
            return $this->getPathWithSubDirectory($className);
        } else {
            return $this->getPathWithoutSubDirectory($className);
        }
    }

    /**
     * @return string
     */
    protected function getPathWithSubDirectory($className)
    {
        $name = $this->getNameArgument();
        $subdir = str_replace('/', '\\', $this->getSubDirectory());
        $className = str_replace("$name\\$subdir\\$name", "$subdir\\$name\\{$this->getRequestName()}", $className);

        return Str::lcfirst(str_replace('\\', '/', $className)) . '.php';
    }

    /**
     * @return string
     */
    protected function getPathWithoutSubDirectory($className)
    {
        $className = Str::replaceFirst($this->rootNamespace(), '', $className) . '.php';
        $className = str_replace(
            "{$this->argument('name')}.php", "{$this->getRequestName()}.php", $className
        );

        return $this->laravel['path'].'/'.str_replace('\\', '/', $className);
    }

    /**
     * @return string
     */
    protected function getRequestName()
    {
        return ucfirst($this->option('ability')) . $this->getNameArgument();
    }

    /**
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . "/stubs/requests/{$this->option('ability')}.stub";
    }

    /**
     * @return string
     */
    protected function getNameArgument()
    {
        $name = trim($this->argument('name'));
        $pivot = strrpos($name, '/');

        if ($pivot !== false) {
            $name = substr($name, $pivot + 1);
        }

        return $name;
    }

    /**
     * @return string
     */
    protected function getSubDirectory()
    {
        $name = trim($this->argument('name'));
        $pivot = strpos($name, '/');

        if ($pivot === false) {
            return null;
        }

        return substr($name, 0, $pivot);
    }

    /**
     * @return string
     */
    protected function hasSubDirectory()
    {
        return strpos($this->argument('name'), '/') !== false;
    }
}
