<?php
/**
 * This file is part of Laravel Dev Extras.
 *
 * (c) Jim Wisley Merioles <jimwisleymerioles@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JimMerioles\LaravelDevExtrasTests;

use Mockery as m;
use Orchestra\Testbench\TestCase;
use JimMerioles\LaravelDevExtras\RepositoryMakeCommand;

class RepositoryMakeCommandTest extends TestCase
{

    /** @test */
    public function it_informs_user_if_repository_generation_successful()
    {
        // Mock the dependency class that does the actual creation of repository.
        $repoMake = m::mock('JimMerioles\LaravelDevExtras\RepositoryMaker');

        // Set expectation, simulate successful creation of repository class by
        // returning true when make() method is called.
        $expectedFullPathWithFilename = 'app/Repositories/FooRepository.php';
        $repoMake->shouldReceive('make')->once()
            ->with($expectedFullPathWithFilename)
            ->andReturn(true);

        // Set expectation that when info() with specific argument message is
        // called it means creation successful.
        $command = m::mock(RepositoryMakeCommand::class.'[info]', [$repoMake]);
        $command->shouldReceive('info')->once()
            ->with($expectedFullPathWithFilename . ' successfully created!');

        // Register partially mocked command class with injected mock to IoC.
        $this->app['Illuminate\Contracts\Console\Kernel']->registerCommand($command);

        // Execute to see if expectations defined above are met.
        $this->artisan('make:repository', ['name' => 'FooRepository']);
    }

    /** @test */
    public function it_errors_to_user_if_repository_generation_fails()
    {
        $repoMake = m::mock('JimMerioles\LaravelDevExtras\RepositoryMaker');

        // Set expectations, simulate failed creation of repository class by
        // returning false when make() method is called.
        $expectedFullPathWithFilename = 'app/Repositories/FooRepository.php';
        $repoMake->shouldReceive('make')->once()
            ->with($expectedFullPathWithFilename)
            ->andReturn(false);

        // Set expectation that when error() with specific argument message is
        // called it means creation failed.
        $command = m::mock(RepositoryMakeCommand::class.'[error]', [$repoMake]);
        $command->shouldReceive('error')->once()
            ->with($expectedFullPathWithFilename . ' not created!');

        $this->app['Illuminate\Contracts\Console\Kernel']->registerCommand($command);

        $this->artisan('make:repository', ['name' => 'FooRepository']);
    }

    /** @test */
    public function it_uses_default_path_if_path_option_not_provided()
    {
        $repoMake = m::mock('JimMerioles\LaravelDevExtras\RepositoryMaker');

        // Set expectations, that make() method should be passed with the correct
        // path(from default path) + file name.
        $expectedFullPathWithFilename = 'app/Repositories/FooRepository.php';
        $repoMake->shouldReceive('make')
            ->with($expectedFullPathWithFilename);

        $command = new RepositoryMakeCommand($repoMake);
        $this->app['Illuminate\Contracts\Console\Kernel']->registerCommand($command);

        // Call command without provided --path.
        $this->artisan('make:repository', ['name' => 'FooRepository']);
    }

    /** @test */
    public function it_uses_provided_path_if_path_option_is_provided()
    {
        $repoMake = m::mock('JimMerioles\LaravelDevExtras\RepositoryMaker');

        // Set expectations, that make() method should be passed with the correct
        // path(from provided option) + name.
        $expectedCustomFullPathWithFilename = 'custom/path/FooRepository.php';
        $repoMake->shouldReceive('make')
            ->with($expectedCustomFullPathWithFilename);

        $command = new RepositoryMakeCommand($repoMake);
        $this->app['Illuminate\Contracts\Console\Kernel']->registerCommand($command);

        // Call command with provided --path.
        $this->artisan('make:repository', ['name' => 'FooRepository', '--path' => 'custom/path/']);
    }

    /** @test */
    public function it_adds_forward_slash_to_path_if_custom_path_provided_does_not_end_in_forward_slash()
    {
        $repoMake = m::mock('JimMerioles\LaravelDevExtras\RepositoryMaker');

        $expectedCustomPathWithFilename = 'custom/path/FooRepository.php';
        $repoMake->shouldReceive('make')
            ->with($expectedCustomPathWithFilename);

        $command = new RepositoryMakeCommand($repoMake);
        $this->app['Illuminate\Contracts\Console\Kernel']->registerCommand($command);

        // Call command with provided --path without forward slash at the end.
        $this->artisan('make:repository', ['name' => 'FooRepository', '--path' => 'custom/path']);
    }
}
