Vous êtes ici : Partie III > Chapitre 5 > lib > OCFram


Application.php
ApplicationComponent.php
BackController.php
Config.php
Entity.php
Field.php
Form.php
FormBuilder.php
FormHandler.php
HTTPRequest.php
HTTPResponse.php
Hydrator.php
Manager.php
Managers.php
MaxLengthValidator.php
NotNullValidator.php
Page.php
PDOFactory.php
Route.php
Router.php
SplClassLoader.php
StringField.php
TextField.php
User.php
Validator.php
<?php

namespace config;

session_start();

class User
{
    public function getAttribute($attr)
    {
        return isset($_SESSION[$attr]) ? $_SESSION[$attr] : null;
    }

    public function getFlash()
    {
        $flash = $_SESSION['flash'];
        unset($_SESSION['flash']);

        return $flash;
    }

    public function hasFlash()
    {
        return isset($_SESSION['flash']);
    }

    public function isAuthenticated()
    {
        return isset($_SESSION['auth']) && $_SESSION['auth'] === true;
    }

    public function setAttribute($attr, $value)
    {
        $_SESSION[$attr] = $value;
    }

    public function setAuthenticated($authenticated = true)
    {
        if (!is_bool($authenticated))
        {
            throw new \InvalidArgumentException('La valeur spécifiée à la méthode User::setAuthenticated() doit être un boolean');
        }

        $_SESSION['auth'] = $authenticated;
    }

    public function setFlash($value)
    {
        $_SESSION['flash'] = $value;
    }
}