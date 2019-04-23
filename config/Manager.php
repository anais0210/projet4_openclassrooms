<?php

namespace App;

/**
 * Class Manager
 * @package App
 */
abstract class Manager
{
    /**
     * @var $dao
     */
    protected $dao;

    /**
     * Manager constructor.
     * @param $dao
     */
    public function __construct($dao)
    {
        $this->dao = $dao;
    }
}