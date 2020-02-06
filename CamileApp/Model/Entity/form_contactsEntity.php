<?php


namespace CamileApp\Model\Entity;


class form_contactsEntity extends Entity
{
    protected $id;
    protected $first_name;
    protected $last_name;
    protected $email;
    protected $subject;
    protected $content;
    protected $user_id;
    protected $date_submission;
    protected $alreadyRead;

    public function __construct()
    {
        $this->setDate_submission();
    }

    /**
     * @return string
     */
    public function getFirst_name()
    {
        return $this->first_name;
    }

    /**
     * @param $first_name
     * @throws Exception
     */
    public function setFirst_name($first_name): void
    {
        if(is_string($first_name))
        {
            $this->first_name = $first_name;
        }
        throw new Exception('typage');
    }

    /**
     * @return string
     */
    public function getLast_name()
    {
        return $this->last_name;
    }

    /**
     * @param $last_name
     * @throws Exception
     */
    public function setLast_name($last_name): void
    {
        if(is_string($last_name))
        {
            $this->last_name = $last_name;
        }
        throw new Exception('typage');
    }


    /**
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }


    /**
     * @param $subject
     * @throws Exception
     */
    public function setSubject($subject): void
    {
        if(is_string($subject))
        {
            $this->subject = $subject;
        }
        throw new Exception('typage');
    }

    /**
     * @return integer
     */
    public function getUser_id()
    {
        return $this->user_id;
    }


    /**
     * @param $user_id
     * @throws Exception
     */
    public function setUser_id($user_id): void
    {
        if(is_int($user_id) && $user_id > 0)
        {
            $this->user_id = $user_id;
        }
        throw new Exception('typage');

    }

    /**
     * @return mixed
     */
    public function getDate_submission()
    {
        return $this->date_submission;
    }

    /**
     * @param mixed $date_submission
     */
    public function setDate_submission($date_submission = null): void
    {
        $this->setDate('date_submission', $date_submission);
    }

    /**
     * @return mixed
     */
    public function getAlreadyRead()
    {
        return $this->alreadyRead;
    }

    /**
     * @param mixed $alreadyRead
     */
    public function setAlreadyRead($alreadyRead): void
    {
        if($alreadyRead === 1 OR $alreadyRead === null)
        {
            $this->alreadyRead = $alreadyRead;
        }
    }
}