<?php
/**
 * This file is part of Laravel Dev Extras.
 *
 * (c) Jim Wisley Merioles <jimwisleymerioles@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JimMerioles\LaravelDevExtras\Console\MakeRepository\Exceptions;

use Exception;

/**
 * Class FileExistsException
 *
 * @since Class available since Release 0.1.0
 */
class FileExistsException extends Exception
{
    /**
     * @param string $path
     * @param int $code
     * @param Exception|null $previous
     */
    public function __construct($path, $code = 0, Exception $previous = null)
    {
        parent::__construct('File already exists: ' . $path, $code, $previous);
    }
}
