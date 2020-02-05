<?php

namespace CamileApp\Model\Entity;

use Exception;

class CommentsEntity extends Entity
{
    protected $id;
    protected $content;
    protected $date_creation;
    protected $post_id;
    protected $user_id;
    protected $validated;
    protected $pseudo;

    public function __construct()
    {
        $this->setDate_creation();
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
        throw new Exception('typage');
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
     * @return mixed
     */
    public function getPost_id()
    {
        return $this->post_id;
    }

    /**
     * @param $post_id
     * @throws Exception
     */
    public function setPost_id($post_id): void
    {
        if(is_int($post_id) && $post_id > 0)
        {
            $this->post_id = $post_id;
        }
        throw new Exception('typage');
    }

    /**
     * @return mixed
     */
    public function getUser_id()
    {
        return $this->user_id;
    }

    /**
     * @param $user_id
     * @throws Exception
     */
    public function setUserId($user_id): void
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
    public function getValidated()
    {
        return $this->validated;
    }

    /**
     * @param mixed $validated
     */
    public function setValidated($validated): void
    {
        if($validated === 1 OR $validated === null)
        {
            $this->validated = $validated;
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
     * @param $pseudo
     * @throws Exception
     */
    public function setPseudo($pseudo): void
    {
        if(is_string($pseudo))
        {
            $this->pseudo = $pseudo;
        }
        throw new Exception('typage');
    }


}