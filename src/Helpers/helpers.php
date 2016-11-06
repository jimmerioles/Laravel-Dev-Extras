<?php
/**
 * This file is part of Laravel Dev Extras.
 *
 * (c) Jim Wisley Merioles <jimwisleymerioles@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

if (!function_exists('db_listen')) {
    /**
     * Listen for sql queries and dump bindings, sql query and execution time.
     * Useful when testing queries with artisan tinker.
     *
     * @return mixed
     * @since Helper function available since Release v0.2.2
     */
    function db_listen()
    {
        return app('db')->listen(function ($query) {
            dump($query->sql);
            dump($query->bindings);
            dump($query->time);
        });
    }
}
