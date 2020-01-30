<?php

namespace CamileApp\Model\Entity;

use Exception;

class UsersEntity
{
    private $id;
    private $pseudo;
    private $email;
    private $statut;
    private $pass;
    private $date_inscription;
    private $validated;
    private $try;
    private $pseudoExists;

    public function __construct()
    {
        $this->setDate_inscription();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        if(is_int($id) && $id > 0)
        {
            $this->id = $id;
        }
        throw new Exception('typage');
    }

    /**
     * @return mixed
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * @param mixed $pseudo
     */
    public function setPseudo($pseudo): void
    {
        if(is_string($pseudo))
        {
            $this->pseudo = $pseudo;
        }
        throw new Exception('typage');
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        if(is_string($email))
        {
            $this->email = $email;
        }
        throw new Exception('typage');
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
        throw new Exception('typage');
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
        throw new Exception('typage');
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
        if(!is_null($date_inscription))
        {
            $this->date_inscription = $date_inscription;
        }

        if(is_string($this->date_inscription))
        {
            $date = date("d/m/Y à H:i", strtotime($this->date_inscription));
            $this->date_inscription = $date;
        }
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