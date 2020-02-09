<?php

namespace CamileApp\Model\Entity;

use Exception;

class UsersEntity extends Entity
{
    protected $id;
    protected $pseudo;
    protected $email;
    protected $statut;
    protected $pass;
    protected $date_inscription;
    protected $validated;
    protected $try;
    protected $pseudoExists;

    public function __construct()
    {
        $this->setDate_inscription();
    }

    /**
     * @return mixed
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * @param mixed $statut
     */
    public function setStatut($statut): void
    {
        if(is_string($statut))
        {
            $this->statut = $statut;
        }
        else
        {
            throw new Exception('typage');
        }
    }

    /**
     * @return mixed
     */
    public function getPass()
    {
        return $this->pass;
    }

    /**
     * @param mixed $pass
     */
    public function setPass($pass): void
    {
        if(is_string($pass))
        {
            $this->pass = $pass;
        }
        else
        {
            throw new Exception('typage');
        }
    }

    /**
     * @return mixed
     */
    public function getDate_inscription()
    {
        return $this->date_inscription;
    }

    /**
     * @param mixed $date_inscription
     */
    public function setDate_inscription($date_inscription = null): void
    {
        $this->setDate('date_inscription', $date_inscription);
    }

    /**
     * @return mixed
     */
    public function getValidated()
    {
        return $this->validated;
    }

    /**
     * @param mixed $validated
     */
    public function setValidated($validated): void
    {
        if($validated === null OR $validated == 1)
        {
            $this->validated = $validated;
        }
    }

    /**
     * @return mixed
     */
    public function getTry()
    {
        return $this->try;
    }

    /**
     * @param mixed $try
     */
    public function setTry($try): void
    {
        if(is_int($try) && $try <= 3)
        {
            $this->try = $try;
        }
    }

    /**
     * @return mixed
     */
    public function getPseudoExists()
    {
        return $this->pseudoExists;
    }

    /**
     * @param mixed $pseudoExists
     */
    public function setPseudoExists($pseudoExists): void
    {
        if($pseudoExists == 0 OR $pseudoExists == 1)
        {
            $this->pseudoExists = $pseudoExists;
        }
    }
}