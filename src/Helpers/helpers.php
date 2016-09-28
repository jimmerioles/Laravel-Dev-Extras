<?php
/**
 * This file is part of Laravel Dev Extras.
 *
 * (c) Jim Wisley Merioles <jimwisleymerioles@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

if (!function_exists('db')) {
    /**
     * Listen for sql queries and dump bindings, sql query and execution time.
     *
     * @return mixed
     */
    function db()
    {
        return app('db')->listen(function ($query) {
            dump($query->bindings);
            dump($query->sql);
            dump($query->time);
        });
    }
}
