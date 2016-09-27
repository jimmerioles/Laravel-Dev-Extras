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

use Illuminate\Filesystem\Filesystem;
use JimMerioles\LaravelDevExtras\Console\MakeRepository\Exceptions\FileExistsException;

/**
 * Class RepositoryMaker
 *
 * @since Class available since Release 0.1.0
 */
class RepositoryMaker
{
    /**
     * Filesystem instance.
     *
     * @var Filesystem
     */
    protected $filesystem;

    /**
     * Create a new RepositoryMaker instance.
     *
     * @param Filesystem $filesystem
     */
    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    /**
     * Make the repository class.
     *
     * @param $pathFile
     * @return bool
     * @throws FileExistsException
     */
    public function make($pathFile)
    {
        if ($this->filesystem->exists($pathFile)) {
            throw new FileExistsException($pathFile);
        }

        $contents = $this->createRepository($this->getClassNameFromPath($pathFile));

        // We first need to check if directory exists and create directory if not exists
        // so that Filesystem::put() will not fail.
        $directoryFromPath = $this->getDirectoryFromPath($pathFile);
        if (!$this->filesystem->exists($directoryFromPath)) {
            $this->filesystem->makeDirectory($directoryFromPath, 0755, true);
        }

        if ($this->filesystem->put($pathFile, $contents)) {
            return true;
        };

        return false;
    }

    /**
     * Create repository content from template.
     *
     * @param $name
     * @return string
     * @internal param $path
     */
    protected function createRepository($name)
    {
        $stub = $this->getStub();

        $template = $this->updateClassName($stub, $name);

        return $template;
    }

    /**
     * Get repository template.
     *
     * @return string
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    protected function getStub()
    {
        return $this->filesystem->get(__DIR__ . '/templates/repository.template');
    }

    /**
     * Update class name in the template with given class name.
     *
     * @param $template
     * @param $className
     * @return string
     */
    protected function updateClassName($template, $className)
    {
        return str_replace('ClassName', $className, $template);
    }

    /**
     * Extract class name from path with filename.
     *
     * @param $path
     * @return string
     */
    protected function getClassNameFromPath($path)
    {
        return basename($path, '.php');
    }

    /**
     * Get directory path from path + file.
     *
     * @param $pathFile
     * @return string
     */
    protected function getDirectoryFromPath($pathFile)
    {
        return dirname($pathFile);
    }
}
