<?php

namespace App\FrontOfficeKernel;

use App\Kernel;

/**
 * Class FrontOfficeKernel
 * @package App\FrontOfficeKernel
 */
class FrontOfficeKernel extends Kernel
{
    /**
     * FrontOfficeKernel constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->name = 'Frontend';
    }

    /**
     * @return mixed|void
     */
    public function run()
    {
        $controller = $this->getController();
        $controller->execute();

        $this->httpResponse->setPage($controller->page());
        $this->httpResponse->send();
    }
}