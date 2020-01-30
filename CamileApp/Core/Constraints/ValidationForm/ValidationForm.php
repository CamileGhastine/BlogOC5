<?php

namespace CamileApp\Core\Constraints\ValidationForm;

/**
 * Class ValidationForm
 * @package CamileApp\Core\Constraints
 */
abstract class ValidationForm
{
    /**
     * form message error sent
     * @var array
     */
    protected $message =[];
    /**
     * list of field that need to be check
     * @var
     */
    protected $keys;

    public function __construct()
    {
        foreach($this->keys as $key)
        {
            $field = 'CamileApp\\Core\\Constraints\\ValidationForm\\Field\\'.ucfirst($key).'Field';
            $this->$key = new $field();
        }
    }

    /**
     * @param $post
     * @return array
     */
    public function checkForm($post)
    {
        foreach($this->keys as $key)
        {
            if($this->$key->check($post[$key]))
            {
                $this->message[$key] = $this->$key->check($post[$key]);
            }
        }

        if($this->message !== [])
        {
            return $this->message;
        }
    }
}