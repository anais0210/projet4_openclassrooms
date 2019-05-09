<?php

namespace App;

/**
 * Class NotNullValidator
 * @package App
 */
class NotNullValidator extends Validator
{
    /**
     * @param $value
     * @return bool
     */
    public function isValid($value)
    {
        return $value != '';
    }
}