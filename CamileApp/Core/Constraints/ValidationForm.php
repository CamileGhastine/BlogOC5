<?php

namespace CamileApp\Core\Constraints;

class ValidationForm
{
    /**
     * Minimum field length
     * @var
     */
    protected $min;
    /**
     * Maximum fiel length
     * @var
     */
    protected $max;

    public function checkValidity($post)
    {
        foreach($post AS $key => $value)
        {
            if(!stristr($key, 'id'))
            {
                if($this->checkField($post[$key], $key))
                {
                    $message[$key] = $this->checkField($post[$key], $key);
                }
            }
        }
        if(isset($message))
        {
            return $message;
        }
    }

    public function checkField($post, $key)
    {

        $this->getConstraints($key);

        if(empty($post))
        {
            return 'Le champs saisi ne doit pas être vide.';
        }

        if(strlen($post) < $this->min)
        {
            return 'Le champs saisi est trop court (minimum ' . $this->min . ' caractères).';
        }

        if($this->max !== null && strlen($post) > $this->max)
        {
            return 'Le champs saisi est trop long (maximum ' . $this->max . ' caractères).';
        }
    }

    public function getConstraints($var)
    {
        $this->min = 3;

        switch($var)
        {
            //post
            case 'title' :
                $this->max = 100;
                break;
            case 'chapo' :
                $this->max = 255;
                break;
            // post and comment
            case 'content' :
                $this->max = null;
                break;
            //category
            case 'name' :
                $this->max = 100;
                break;
            case 'description' :
                $this->max = 255;
                break;

        }
    }
}