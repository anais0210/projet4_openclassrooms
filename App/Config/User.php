<?php

namespace App\Config;

session_start();

/**
 * Class User
 * @package App
 */
class User
{
    /**
     * @param $attr
     * @return mixed|null
     */
    public function getAttribute($attr)
    {
        return isset($_SESSION[$attr]) ? $_SESSION[$attr] : null;
    }

    /**
     * @return mixed
     */
    public function getFlash()
    {
        $flash = $_SESSION['flash'];
        unset($_SESSION['flash']);

        return $flash;
    }

    /**
     * @return bool
     */
    public function hasFlash()
    {
        return isset($_SESSION['flash']);
    }

    /**
     * @return bool
     */
    public function isAuthenticated()
    {
        return isset($_SESSION['auth']) && $_SESSION['auth'] === true;
    }

    /**
     * @param $attr
     * @param $value
     */
    public function setAttribute($attr, $value)
    {
        $_SESSION[$attr] = $value;
    }

    /**
     * @param bool $authenticated
     */
    public function setAuthenticated($authenticated = true)
    {
        if (!is_bool($authenticated))
        {
            throw new \InvalidArgumentException('La valeur spécifiée à la méthode User::setAuthenticated() doit être un boolean');
        }

        $_SESSION['auth'] = $authenticated;
    }

    /**
     * @param $value
     */
    public function setFlash($value)
    {
        $_SESSION['flash'] = $value;
    }
}