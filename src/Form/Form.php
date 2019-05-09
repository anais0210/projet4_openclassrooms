<?php

namespace App;

/**
 * Class Form
 * @package App
 */
class Form
{
    /**
     * @var $entity
     */
    protected $entity;

    /**
     * @var array
     */
    protected $fields = [];

    /**
     * Form constructor.
     * @param Entity $entity
     */
    public function __construct(Entity $entity)
    {
        $this->setEntity($entity);
    }

    /**
     * @param Field $field
     * @return $this
     */
    public function add(Field $field)
    {
        $attr = $field->name(); // On récupère le nom du champ.
        $field->setValue($this->entity->$attr()); // On assigne la valeur correspondante au champ.

        $this->fields[] = $field; // On ajoute le champ passé en argument à la liste des champs.
        return $this;
    }

    /**
     * @return string
     */
    public function createView()
    {
        $view = '';

        // On génère un par un les champs du formulaire.
        foreach ($this->fields as $field)
        {
            $view .= $field->buildWidget().'<br />';
        }

        return $view;
    }

    /**
     * @return bool
     */
    public function isValid()
    {
        $valid = true;

        // On vérifie que tous les champs sont valides.
        foreach ($this->fields as $field)
        {
            if (!$field->isValid())
            {
                $valid = false;
            }
        }

        return $valid;
    }

    /**
     * @return mixed
     */
    public function entity()
    {
        return $this->entity;
    }

    /**
     * @param Entity $entity
     */
    public function setEntity(Entity $entity)
    {
        $this->entity = $entity;
    }
}