<?php

namespace App;

/**
 * Class FormBuilder
 * @package App
 */
abstract class FormBuilder
{
    /**
     * @var $form
     */
    protected $form;

    /**
     * FormBuilder constructor.
     * @param Entity $entity
     */
    public function __construct(Entity $entity)
    {
        $this->setForm(new Form($entity));
    }

    /**
     * @return mixed
     */
    abstract public function build();

    /**
     * @param Form $form
     */
    public function setForm(Form $form)
    {
        $this->form = $form;
    }

    /**
     * @return mixed
     */
    public function form()
    {
        return $this->form;
    }
}