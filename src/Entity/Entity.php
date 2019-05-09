<?php

namespace App;

/**
 * Class Entity
 * @package App
 */
abstract class Entity implements \ArrayAccess
{
    use Hydrator;

    /**
     * @var array
     */
    protected $erreurs = [],
        $id;

    /**
     * Entity constructor.
     * @param array $donnees
     */
    public function __construct(array $donnees = [])
    {
        if (!empty($donnees)) {
            $this->hydrate($donnees);
        }
    }

    /**
     * @return bool
     */
    public function isNew()
    {
        return empty($this->id);
    }

    /**
     * @return array
     */
    public function erreurs()
    {
        return $this->erreurs;
    }

    /**
     * @return array
     */
    public function id()
    {
        return $this->id;
    }

    /**
     * @param $id
     */
    public function setId($id)
    {
        $this->id = (int)$id;
    }

    /**
     * @param mixed $var
     * @return mixed
     */
    public function offsetGet($var)
    {
        if (isset($this->$var) && is_callable([$this, $var])) {
            return $this->$var();
        }
    }

    /**
     * @param mixed $var
     * @param mixed $value
     */
    public function offsetSet($var, $value)
    {
        $method = 'set' . ucfirst($var);

        if (isset($this->$var) && is_callable([$this, $method])) {
            $this->$method($value);
        }
    }

    /**
     * @param mixed $var
     * @return bool
     */
    public function offsetExists($var)
    {
        return isset($this->$var) && is_callable([$this, $var]);
    }

    /**
     * @param mixed $var
     * @throws \Exception
     */
    public function offsetUnset($var)
    {
        throw new \Exception('Impossible de supprimer une quelconque valeur');
    }
}