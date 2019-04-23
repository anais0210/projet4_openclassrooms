<?php

namespace App;

/**
 * Class BackOfficeController
 * @package App
 */
abstract class BackOfficeController extends KernelComponent
{
    /**
     * @var string
     */
    protected $action = '';

    /**
     * @var string
     */
    protected $module = '';

    /**
     * @var Page|null
     */
    protected $page = null;

    /**
     * @var string
     */
    protected $view = '';

    /**
     * @var Managers|null
     */
    protected $managers = null;

    /**
     * BackOfficeController constructor.
     * @param Kernel $app
     * @param        $module
     * @param        $action
     */
    public function __construct(Kernel $app, $module, $action)
    {
        parent::__construct($app);

        $this->managers = new Managers('PDO', PDOFactory::Connect());
        $this->page = new Page($app);

        $this->setModule($module);
        $this->setAction($action);
        $this->setView($action);
    }

    /**
     * @method execute
     */
    public function execute()
    {
        $method = 'execute' . ucfirst($this->action);

        if (!is_callable([$this, $method])) {
            throw new \RuntimeException('L\'action "' . $this->action . '" n\'est pas définie sur ce module');
        }

        $this->$method($this->app->httpRequest());
    }

    /**
     * @return Page|null
     */
    public function page()
    {
        return $this->page;
    }

    /**
     * @param $module
     */
    public function setModule($module)
    {
        if (!is_string($module) || empty($module)) {
            throw new \InvalidArgumentException('Le module doit être une chaine de caractères valide');
        }

        $this->module = $module;
    }

    /**
     * @param $action
     */
    public function setAction($action)
    {
        if (!is_string($action) || empty($action)) {
            throw new \InvalidArgumentException('L\'action doit être une chaine de caractères valide');
        }

        $this->action = $action;
    }

    /**
     * @param $view
     */
    public function setView($view)
    {
        if (!is_string($view) || empty($view)) {
            throw new \InvalidArgumentException('La vue doit être une chaine de caractères valide');
        }

        $this->view = $view;

        $this->page->setContentFile(__DIR__ . '/../../App/' . $this->app->name() . '/Modules/' . $this->module . '/Views/' . $this->view . '.php');
    }
}