<?php
/**
 * This file is part of Laravel Dev Extras.
 *
 * (c) Jim Wisley Merioles <jimwisleymerioles@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JimMerioles\LaravelDevExtrasTests\Console\MakeRepository;

use Illuminate\Support\Facades\Artisan;
use JimMerioles\LaravelDevExtras\LaravelDevExtrasServiceProvider;
use Orchestra\Testbench\TestCase;

/**
 * Class RepositoryMakeCommandTest
 *
 * @author Jim Wisley Merioles <jimwisleymerioles@gmail.com>
 * @since Test class available since Release v0.2.2
 */
class RepositoryMakeCommandTest extends TestCase
{
    /** @test */
    public function it_generates_basic_repository()
    {
        $this->artisan('make:repository', ['name' => 'FooRepository']);

        $this->assertEquals("Repository created successfully.\n", Artisan::output());
        $this->assertFileExists(app_path('Repositories/FooRepository.php'));
        $this->assertFileEquals(__DIR__ . '/stubs/FooRepository.php', app_path('Repositories/FooRepository.php'));
    }

    /** @test */
    public function it_generates_model_populated_repository_if_model_option_provided()
    {
        $this->artisan('make:repository', ['name' => 'BarRepository', '--model' => "Bar"]);

        $this->assertEquals("Repository created successfully.\n", Artisan::output());
        $this->assertFileExists(app_path('Repositories/BarRepository.php'));
        $this->assertFileEquals(__DIR__ . '/stubs/WithModelOption/BarRepository.php',
            app_path('Repositories/BarRepository.php'));
    }

    /**
     * Clean up the testing environment before the next test.
     *
     * @return void
     */
    protected function tearDown()
    {
        // Reset related fixture before tearing down application setup on every test.
        $this->app['files']->deleteDirectory(app_path('Repositories'));

        parent::tearDown();
    }

    /**
     * Get package providers.
     *
     * @param  \Illuminate\Foundation\Application $app
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [LaravelDevExtrasServiceProvider::class];
    }
}
