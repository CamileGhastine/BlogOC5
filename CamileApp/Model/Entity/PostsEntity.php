<?php

namespace CamileApp\Model\Entity;

use Exception;

/**
 * Class PostsEntity
 */
class PostsEntity extends Entity
{
    protected $id;
    protected $title;
    protected $chapo;
    protected $content;
    protected $date_creation;
    protected $date_modification;
    protected $category_id;
    protected $user_id;
    protected $url;
    protected $pseudo;
    /**
     * Number validated comments
     * @var
     */
    private $numberComments;
    /**
     * Number unvaildated Comments
     * @var
     */
    private $numberUnvalidated;
    private $category;

    public function __construct()
    {
        $this->setDate_creation();
        $this->setDate_modification();
        $this->setUrl();
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }


    /**
     * @param $title
     * @throws Exception
     */
    public function setTitle($title): void
    {
        if(is_string($title))
        {
            $this->title = $title;
        }
        else
        {
            throw new Exception('typage');
        }
    }

    /**
     * @return string
     */
    public function getChapo()
    {
        return $this->chapo;
    }


    /**
     * @param $chapo
     * @throws Exception
     */
    public function setChapo($chapo): void
    {
        if(is_string($chapo))
        {
            $this->chapo = $chapo;
        }
        else
        {
            throw new Exception('typage');
        }
    }

    /**
     * @return mixed
     */
    public function getDate_modification()
    {
        return $this->date_modification;
    }

    /**
     * @param mixed $date_modification
     */
    public function setDate_modification($date_modification = null): void
    {
        $this->setDate('date_modification', $date_modification);
    }

    /**
     * @return integer
     */
    public function getCategory_id()
    {
        return $this->category_id;
    }


    /**
     * @param $category_id
     * @throws Exception
     */
    public function setCategory_id($category_id): void
    {
        if(is_int($category_id) && $category_id > 0)
        {
            $this->category_id = $category_id;
        }
        else
        {
            throw new Exception('typage');
        }

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
        else
        {
            throw new Exception('typage');
        }

    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }


    /**
     *
     */
    public function setUrl(): void
    {
        $this->url = 'index.php?route=front.postById&id=' . $this->id;
    }

    /**
     * @return mixed
     */
    public function getNumberComments()
    {
        return $this->numberComments;
    }

    /**
     * @param mixed $numberComments
     */
    public function setNumberComments($numberComments): void
    {
        $this->numberComments = $numberComments;
    }

    /**
     * @return mixed
     */
    public function getNumberUnvalidated()
    {
        return $this->numberUnvalidated;
    }

    /**
     * @param mixed $numberComments
     */
    public function setNumberUnvalidated($numberUnvalidated): void
    {
        $this->numberUnvalidated = $numberUnvalidated;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category): void
    {
        $this->category = $category;
    }


}