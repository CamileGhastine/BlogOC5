<?php


namespace CamileApp\Core\Constraints;


class RegisterValidationForm extends ValidationForm
{
    protected $keys = ['pseudo', 'email', 'pass', 'passConfirm'];
    protected $pass;

    /**
     * Class usersValidationForm
     * @param $var
     */
    public function getConstraints($var)
    {
        switch($var)
        {
            case 'pseudo' :
                $this->min = 3;
                $this->max = 50;
                break;
            case 'email' :
                $this->min = 8;
                $this->max = 50;
                break;
            case 'pass' :
                $this->min = 6;
                $this->max = 50;
                break;
        }
    }

    public function moreConstraints($value, $key)
    {
        if($key == 'email')
        {
            if(!stristr($value, '@') OR !stristr($value, '.'))
            {
                return 'le format courriel n\'est pas respecté.';
            }
        }

        if($key == 'pass')
        {
            $this->pass = $value;
        }

        if($key == 'passConfirm')
        {
            if($this->pass != $value)
            {
                return 'les deux mots de passe saisis sont différents.';
            }
        }

    }
}