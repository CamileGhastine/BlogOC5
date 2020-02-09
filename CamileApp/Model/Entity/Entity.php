<?php


namespace CamileApp\Model\Entity;

use Exception;

class Entity
{
    protected $id;
    protected $content;
    protected $pseudo;
    protected $email;
    protected $date_creation;

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
        else
        {
            throw new Exception('typage');
        }
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param $content
     * @throws Exception
     */
    public function setContent($content): void
    {
        if(is_string($content))
        {
            $this->content = $content;
        }
        else
        {
            throw new Exception('typage');
        }
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
        $this->pseudo = $pseudo;
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
        else
        {
            throw new Exception('typage');
        }
    }

    /**
     * @return mixed
     */
    public function getDate_creation()
    {
        return $this->date_creation;
    }

    /**
     * @param mixed $date_creation
     */
    public function setDate_creation($date_creation = null): void
    {
        $this->setDate('date_creation', $date_creation);
    }

    /**
     * change de format of the date
     * @param $date_action
     * @param $date
     */
    protected function setDate($date_action, $date)
    {
        if(!is_null($date))
        {
            $this->$date_action = $date;
        }

        if(is_string($this->$date_action))
        {
            $newDateFormat = date("d/m/Y à H:i", strtotime($this->$date_action));
            $this->$date_action = $newDateFormat;
        }
    }
}