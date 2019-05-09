<?php

namespace App;

/**
 * Class MaxLengthValidator
 * @package App
 */
class MaxLengthValidator extends Validator
{
    /**
     * @var
     */
    protected $maxLength;

    /**
     * MaxLengthValidator constructor.
     * @param $errorMessage
     * @param $maxLength
     */
    public function __construct($errorMessage, $maxLength)
    {
        parent::__construct($errorMessage);

        $this->setMaxLength($maxLength);
    }

    /**
     * @param $value
     * @return bool
     */
    public function isValid($value)
    {
        return strlen($value) <= $this->maxLength;
    }

    /**
     * @param $maxLength
     */
    public function setMaxLength($maxLength)
    {
        $maxLength = (int)$maxLength;

        if ($maxLength > 0) {
            $this->maxLength = $maxLength;
        } else {
            throw new \RuntimeException('La longueur maximale doit être un nombre supérieur à 0');
        }
    }
}