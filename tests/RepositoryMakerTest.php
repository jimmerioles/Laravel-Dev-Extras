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
use Illuminate\Filesystem\Filesystem;
use JimMerioles\LaravelDevExtras\Console\MakeRepository\RepositoryMaker;
use JimMerioles\LaravelDevExtras\Console\MakeRepository\Exceptions\FileExistsException;

class RepositoryMakerTest extends TestCase
{
    /** @test */
    public function it_generates_repository_from_template()
    {
        // Stub for expected content.
        $expectedContent = file_get_contents(__DIR__ . '/stubs/repository.stub');

        $filesystemMock = m::mock(Filesystem::class . '[put, makeDirectory]');

        // Mock FileSystem::makeDirectory() so that it wont create directories when testing.
        $filesystemMock->shouldReceive('makeDirectory');

        // Expect that Filesystem::put() will be passed with expected path and content.
        $expectedFullPathWithFilename = 'app/Repositories/FooRepository.php';
        $filesystemMock->shouldReceive('put')->once()
            ->with($expectedFullPathWithFilename, $expectedContent);

        $maker = new RepositoryMaker($filesystemMock);

        // Run method under test.
        $maker->make($expectedFullPathWithFilename);
    }

    /** @test */
    public function it_throws_file_exists_exception_with_appropriate_message_if_file_already_exists()
    {
        // Set expectation, that it throws FileExistsException exception.
        $path = __DIR__ . '/stubs/repository.stub';
        $this->expectException(FileExistsException::class);
        $this->expectExceptionMessage("File already exists: " . $path);

        $mockedFilesystem = m::mock(Filesystem::class . '[exists]');

        // Simulate file exists to throw the FileExistsException.
        $mockedFilesystem->shouldReceive('exists')->once()
            ->andReturn(true);

        $maker = new RepositoryMaker($mockedFilesystem);

        // Run method under test with physically existing path + filename.
        $maker->make($path);
    }
}
