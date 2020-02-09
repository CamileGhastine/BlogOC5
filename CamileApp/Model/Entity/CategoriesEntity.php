<?php

namespace CamileApp\Model\Entity;

use Exception;

/**
 * Class CategoriesEntity
 * @package CamileApp\Model\Entity
 */
class CategoriesEntity extends Entity
{
    protected $id;
    protected $name;
    protected $description;
    protected $url;
    protected $numberPosts;

    public function __construct()
    {
        $this->setUrl();
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }


    /**
     * @param $name
     * @throws Exception
     */
    public function setName($name): void
    {
        if(is_string($name))
        {
            $this->name = $name;
        }
        else
        {
            throw new Exception('typage');
        }
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param $description
     * @throws Exception
     */
    public function setDescription($description): void
    {
        if(is_string($description))
        {
            $this->description = $description;
        }
        else
        {
            throw new Exception('typage');
        }
    }

    /**
     * @return mixed
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
        $this->url = 'index.php?route=front.postsByCategory&id=' . $this->id;
    }

    /**
     * @return mixed
     */
    public function getNumberPosts()
    {
        return $this->numberPosts;
    }

    /**
     * @param mixed $numberPosts
     */
    public function setNumberPosts($numberPosts): void
    {
        $this->numberPosts = $numberPosts;
    }


}