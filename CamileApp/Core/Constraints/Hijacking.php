<?php

namespace CamileApp\Core\Constraints;

/**
 * Class Hijacking to prevent from hijacking session
 * @package CamileApp\Core\Constraints
 */
class Hijacking
{
    /**
     * Number of trying connexion allow before blocking the registered user account
     * @var int
     */
    protected $try;

    public function __construct($try)
    {
        $this->try = $try;
    }

    /**
     * @return mixed
     */
    public function getTry()
    {
        return $this->try;
    }
}