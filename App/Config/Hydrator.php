<?php

namespace App\Config;

/**
 * Trait Hydrator
 * @package App
 */
trait Hydrator
{
    /**
     * @param $data
     */
    public function hydrate($data)
    {
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);

            if (is_callable([$this, $method])) {
                $this->$method($value);
            }
        }
    }
}