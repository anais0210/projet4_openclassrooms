<?php

namespace config;

abstract class KernelComponent
{
    protected $app;

    public function __construct(Kernel $app)
    {
        $this->app = $app;
    }

    public function app()
    {
        return $this->app;
    }
}