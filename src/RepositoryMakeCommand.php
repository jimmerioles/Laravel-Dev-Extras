<?php
/**
 * This file is part of Laravel Dev Extras.
 *
 * (c) Jim Wisley Merioles <jimwisleymerioles@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JimMerioles\LaravelDevExtras;

use Illuminate\Console\Command;

/**
 * Class RepositoryMakeCommand
 *
 * @since Class available since Release 0.1.0
 */
class RepositoryMakeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repository
                            {name : Name of the class.}
                            {--path=app/Repositories/ : Path to create repository.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new repository class';

    /**
     * RepositoryMake instance.
     *
     * @var
     */
    protected $repositoryMaker;

    /**
     * Create a new command instance.
     *
     * @param RepositoryMaker $repositoryMaker
     */
    public function __construct(RepositoryMaker $repositoryMaker)
    {
        parent::__construct();

        $this->repositoryMaker = $repositoryMaker;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $path = $this->getPathWithFilename();

        if ($this->repositoryMaker->make($path)) {
            return $this->info($path . ' successfully created!');
        }

        return $this->error($path . ' not created!');
    }

    /**
     * Get complete path with filename.
     *
     * @return string
     */
    protected function getPathWithFilename()
    {
        return $this->getPath() . $this->argument('name') . '.php';
    }

    /**
     * Get path only.
     *
     * @return string
     */
    protected function getPath()
    {
        $path = $this->option('path');

        return $this->normalizePath($path);
    }

    /**
     * Normalize path to see to it that it ends with forward slash.
     *
     * @param $path
     * @return string
     */
    protected function normalizePath($path)
    {
        return (ends_with($path, '/')) ? $path : $path . '/';
    }
}
