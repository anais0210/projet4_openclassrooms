<?php

namespace App\Backend;

use App\BackOffice\Modules\Connexion\ConnexionController;
use App\Kernel;

/**
 * Class BackOfficeKernel
 * @package App\Backend
 */
class BackOfficeKernel extends Kernel
{
    public function __construct()
    {
        parent::__construct();

        $this->name = 'Backend';
    }

    /**
     * @return mixed|void
     */
    public function run()
    {
        if ($this->user->isAuthenticated()) {
            $controller = $this->getController();
        } else {
            $controller = new ConnexionController($this, 'Connexion', 'index');
        }

        $controller->execute();

        $this->httpResponse->setPage($controller->page());
        $this->httpResponse->send();
    }
}