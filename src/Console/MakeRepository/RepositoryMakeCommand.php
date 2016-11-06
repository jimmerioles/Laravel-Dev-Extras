<?php
/**
 * This file is part of Laravel Dev Extras.
 *
 * (c) Jim Wisley Merioles <jimwisleymerioles@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JimMerioles\LaravelDevExtras\Console\MakeRepository;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

/**
 * Class RepositoryMakeCommand generates repository class.
 *
 * @author Jim Wisley Merioles <jimwisleymerioles@gmail.com>
 * @since Class available since Release v0.2.2
 */
class RepositoryMakeCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:repository';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new repository class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Repository';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        if ($this->option('model')) {
            return __DIR__ . '/stubs/repository-model.stub';
        }

        return __DIR__ . '/stubs/repository.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Repositories';
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['model', 'm', InputOption::VALUE_OPTIONAL, 'Create repository based on model.'],
        ];
    }

    /**
     * Build the class with the given name.
     *
     * @param  string $name
     * @return string
     */
    protected function buildClass($name)
    {
        $stub = parent::buildClass($name);

        if ($this->option('model')) {
            $stub = $this->replaceModel($stub, $this->option('model'));
        }

        return $stub;
    }

    /**
     * Replace the model name and variable declarations for the given stub.
     *
     * @param $stub
     * @param $model
     * @return $this
     */
    protected function replaceModel($stub, $model)
    {
        $stub = str_replace('DummyModel', $model, $stub);
        $stub = str_replace('dummyModelVar', strtolower($model), $stub);

        return $stub;
    }
}
