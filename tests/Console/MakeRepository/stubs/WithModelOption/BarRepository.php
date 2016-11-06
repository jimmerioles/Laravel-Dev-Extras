<?php

namespace App\Repositories;

use Bar;

class BarRepository
{
    /**
     * Bar model instance.
     *
     * @var Bar
     */
    protected $bar;

    /**
     * Create a new repository instance.
     *
     * @param Bar $bar
     */
    public function __construct(Bar $bar)
    {
        $this->bar = $bar;

        //
    }
}
