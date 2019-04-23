<?php

namespace App;

/**
 * Class HTTPResponse
 * @package App
 */
class HTTPResponse extends KernelComponent
{
    /**
     * @var $page
     */
    protected $page;

    /**
     * @param $header
     */
    public function addHeader($header)
    {
        header($header);
    }

    /**
     * @param $location
     */
    public function redirect($location)
    {
        header('Location: ' . $location);
        exit;
    }

    /**
     * @function redirect404
     */
    public function redirect404()
    {
        $this->page = new Page($this->app);
        $this->page->setContentFile(__DIR__ . '/../../Errors/404.html');

        $this->addHeader('HTTP/1.0 404 Not Found');

        $this->send();
    }

    /**
     * @function send
     */
    public function send()
    {
        exit($this->page->getGeneratedPage());
    }

    /**
     * @param Page $page
     */
    public function setPage(Page $page)
    {
        $this->page = $page;
    }

    /**
     * @param        $name
     * @param string $value
     * @param int    $expire
     * @param null   $path
     * @param null   $domain
     * @param bool   $secure
     * @param bool   $httpOnly
     */
    public function setCookie($name, $value = '', $expire = 0, $path = null, $domain = null, $secure = false, $httpOnly = true)
    {
        setcookie($name, $value, $expire, $path, $domain, $secure, $httpOnly);
    }
}