<?php

namespace App\BackOffice\Modules\Connexion;

use App\BackOfficeController;
use App\HTTPRequest;

/**
 * Class ConnexionController
 * @package App\BackOffice\Modules\Connexion
 */
class ConnexionController extends BackOfficeController
{
    /**
     * @param HTTPRequest $request
     */
    public function executeIndex(HTTPRequest $request)
    {
        $this->page->addVar('title', 'Connexion');

        if ($request->postExists('login'))
        {
            $login = $request->postData('login');
            $password = $request->postData('password');

            if ($login == $this->app->config()->get('login') && $password == $this->app->config()->get('pass'))
            {
                $this->app->user()->setAuthenticated(true);
                $this->app->httpResponse()->redirect('.');
            }
            else
            {
                $this->app->user()->setFlash('Le pseudo ou le mot de passe est incorrect.');
            }
        }
    }
}