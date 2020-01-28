<?php

namespace CamileApp\Core\Constraints;

/**
 * Class ValidationForm
 * @package CamileApp\Core\Constraints
 */
abstract class ValidationForm
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
            if(in_array($key, $this->keys))
            {
                if($this->checkField($value, $key))
                {
                    $message[$key] = $this->checkField($value, $key);
                }
            }
        }
        if(isset($message))
        {
            return $message;
        }
    }

    public function checkField($value, $key)
    {

        $this->getConstraints($key);

        if($this->moreConstraints($value, $key) != null)
        {
            return $this->moreConstraints($value, $key);
        }

        if(empty($value))
        {
            return 'Ce champs  ne peut pas être vide.';
        }

        if(strlen($value) < $this->min)
        {
            return 'Le champs saisi est trop court (minimum ' . $this->min . ' caractères).';
        }

        if($this->max !== null && strlen($value) > $this->max)
        {
            return 'Le champs saisi est trop long (maximum ' . $this->max . ' caractères).';
        }

    }


}