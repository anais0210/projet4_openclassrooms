<?php

namespace App;

/**
 * Class FormHandler
 * @package App
 */
class FormHandler
{
    /**
     * @var $form
     */
    protected $form;

    /**
     * @var $manager
     */
    protected $manager;

    /**
     * @var $request
     */
    protected $request;

    /**
     * FormHandler constructor.
     * @param Form        $form
     * @param Manager     $manager
     * @param HTTPRequest $request
     */
    public function __construct(Form $form, Manager $manager, HTTPRequest $request)
    {
        $this->setForm($form);
        $this->setManager($manager);
        $this->setRequest($request);
    }

    /**
     * @return bool
     */
    public function process()
    {
        if ($this->request->method() == 'POST' && $this->form->isValid()) {
            $this->manager->save($this->form->entity());

            return true;
        }

        return false;
    }

    /**
     * @param Form $form
     */
    public function setForm(Form $form)
    {
        $this->form = $form;
    }

    /**
     * @param Manager $manager
     */
    public function setManager(Manager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @param HTTPRequest $request
     */
    public function setRequest(HTTPRequest $request)
    {
        $this->request = $request;
    }
}