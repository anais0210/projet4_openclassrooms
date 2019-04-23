<?php

namespace App;

/**
 * Class Field
 * @package App
 */
abstract class Field
{
    use Hydrator;

    /**
     * @var $errorMessage string
     */
    protected $errorMessage;

    /**
     * @var $label
     */
    protected $label;

    /**
     * @var $name string
     */
    protected $name;

    /**
     * @var $validators array
     */
    protected $validators = [];

    /**
     * @var $value string
     */
    protected $value;

    /**
     * Field constructor.
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        if (!empty($options)) {
            $this->hydrate($options);
        }
    }

    /**
     * @return mixed
     */
    abstract public function buildWidget();

    /**
     * @return bool
     */
    public function isValid()
    {
        foreach ($this->validators as $validator) {
            if (!$validator->isValid($this->value)) {
                $this->errorMessage = $validator->errorMessage();

                return false;
            }
        }

        return true;
    }

    /**
     * @return mixed
     */
    public function label()
    {
        return $this->label;
    }

    /**
     * @return mixed
     */
    public function length()
    {
        return $this->length;
    }

    /**
     * @return string
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function validators()
    {
        return $this->validators;
    }

    /**
     * @return string
     */
    public function value()
    {
        return $this->value;
    }

    /**
     * @param $label
     */
    public function setLabel($label)
    {
        if (is_string($label)) {
            $this->label = $label;
        }
    }

    /**
     * @param $length
     */
    public function setLength($length)
    {
        $length = (int)$length;

        if ($length > 0) {
            $this->length = $length;
        }
    }

    /**
     * @param $name
     */
    public function setName($name)
    {
        if (is_string($name)) {
            $this->name = $name;
        }
    }

    /**
     * @param array $validators
     */
    public function setValidators(array $validators)
    {
        foreach ($validators as $validator) {
            if ($validator instanceof Validator && !in_array($validator, $this->validators)) {
                $this->validators[] = $validator;
            }
        }
    }

    /**
     * @param $value
     */
    public function setValue($value)
    {
        if (is_string($value)) {
            $this->value = $value;
        }
    }
}