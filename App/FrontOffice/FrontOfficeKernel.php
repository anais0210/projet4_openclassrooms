<?php

namespace App\FrontOffice;

use App\Config\Kernel;

/**
 * Class FrontOfficeKernel
 * @package App\FrontOffice
 */
class FrontOfficeKernel extends Kernel
{
    /**
     * FrontOfficeKernel constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->name = 'FrontOffice';
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