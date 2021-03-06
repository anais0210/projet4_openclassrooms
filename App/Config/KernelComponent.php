<?php

namespace App\Config;

/**
 * Class KernelComponent
 * @package App\Config
 */
abstract class KernelComponent
{
    /**
     * @var Kernel
     */
    protected $app;

    /**
     * KernelComponent constructor.
     * @param Kernel $app
     */
    public function __construct(Kernel $app)
    {
        $this->app = $app;
    }

    /**
     * @return Kernel
     */
    public function app()
    {
        return $this->app;
    }
}