<?php

namespace Maksa988\LaravelAdmin\Console;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;
use InvalidArgumentException;
use Symfony\Component\Console\Input\InputOption;

class ControllerMakeCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'admin:controller';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new admin controller class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Controller';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        if($this->option('request')) {
            return __DIR__ . '/stubs/request.controller.stub';
        }

        return __DIR__ . '/stubs/controller.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Http\Controllers\Admin';
    }

    /**
     * Build the class with the given name.
     *
     * Remove the base controller import if we are already in base namespace.
     *
     * @param  string $name
     * @return string
     */
    protected function buildClass($name)
    {
        $controllerNamespace = $this->getNamespace($name);

        $replace = [];

        $replace = $this->buildModelReplacements($replace);

        if($this->option('request')) {
            $replace = $this->buildRequestReplacements($replace);
        }

        $replace["use {$controllerNamespace}\Controller;\n"] = '';

        return str_replace(
            array_keys($replace), array_values($replace), parent::buildClass($name)
        );

    }

    /**
     * Build the request replacement values.
     *
     * @param  array $replace
     * @return array
     */
    protected function buildRequestReplacements(array $replace)
    {
        $requestClass = $this->parseRequest($this->option('request'));

        if(! class_exists($requestClass)) {
            if($this->confirm("A {$requestClass} request does not exist. Do you want to generate it?", true)) {
                $this->call('admin:request', ['name' => class_basename($requestClass)]);
            }
        }

        return array_merge($replace, [
            'DummyFullRequestClass' => $requestClass,
            'DummyRequestClass' => class_basename($requestClass),
        ]);
    }

    /**
     * Get the fully-qualified request class name.
     *
     * @param  string  $request
     * @return string
     *
     * @throws \InvalidArgumentException
     */
    protected function parseRequest($request)
    {
        $request = Str::replaceLast('Request', '', $request);

        if (preg_match('([^A-Za-z0-9_/\\\\])', $request)) {
            throw new InvalidArgumentException('Request name contains invalid characters.');
        }

        $request = trim(str_replace('/', '\\', $request), '\\');

        if (! Str::startsWith($request, $rootNamespace = $this->laravel->getNamespace())) {
            $request = $rootNamespace.'Http\Requests\Admin\\'.$request;
        }

        return $request . 'Request';
    }

    /**
     * Build the model replacement values.
     *
     * @param  array $replace
     * @return array
     */
    protected function buildModelReplacements(array $replace)
    {
        $modelClass = $this->parseModel($this->option('model'));

        if (!class_exists($modelClass)) {
            if ($this->confirm("A {$modelClass} model does not exist. Do you want to generate it?", true)) {
                $this->call('make:model', ['name' => $modelClass]);
            }
        }

        return array_merge($replace, [
            'DummyFullModelClass' => $modelClass,
            'DummyModelClass' => class_basename($modelClass),
            'DummyModelVariable' => lcfirst(class_basename($modelClass)),
        ]);
    }

    /**
     * Get the fully-qualified model class name.
     *
     * @param  string  $model
     * @return string
     *
     * @throws \InvalidArgumentException
     */
    protected function parseModel($model)
    {
        if (preg_match('([^A-Za-z0-9_/\\\\])', $model)) {
            throw new InvalidArgumentException('Model name contains invalid characters.');
        }

        $model = trim(str_replace('/', '\\', $model), '\\');

        if (! Str::startsWith($model, $rootNamespace = $this->laravel->getNamespace())) {
            $model = $rootNamespace.$model;
        }

        return $model;
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['model', 'm', InputOption::VALUE_REQUIRED, 'Generate a resource controller for the given model.'],
            ['request', 'r', InputOption::VALUE_OPTIONAL, 'Generate a resource controller with a given request class.'],
        ];
    }
}
