<?php
/**
 * This file is part of Laravel Dev Extras.
 *
 * (c) Jim Wisley Merioles <jimwisleymerioles@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JimMerioles\LaravelDevExtrasTests\Helpers;

use Mockery as M;
use Orchestra\Testbench\TestCase;

/**
 * Class HelpersTest
 *
 * @author Jim Wisley Merioles <jimwisleymerioles@gmail.com>
 * @since Test class available since Release v0.2.2
 */
class HelpersTest extends TestCase
{
    /** @test */
    public function dblisten_listens_for_database_queries()
    {
        $this->app['db'] = $db = M::mock('StdClass');

        $db->shouldReceive('listen')->once()->andReturnNull();

        $this->assertNull(db_listen());
    }
}
