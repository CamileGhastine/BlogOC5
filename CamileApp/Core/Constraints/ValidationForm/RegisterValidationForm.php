<?php


namespace CamileApp\Core\Constraints\ValidationForm;


/**
 * Class RegisterValidationForm
 * @package CamileApp\Core\Constraints
 */
class RegisterValidationForm extends ValidationForm
{
    protected $pseudo;
    protected $email;
    protected $pass;
    protected $passConfirm;
    protected $keys = ['pseudo', 'email', 'pass', 'passConfirm'];
    // Stock pass and passConfirm to compare its
    protected $passStock;
    protected $passConfirmStock;

    public function checkForm($post)
    {
        foreach($this->keys as $key)
        {
            // Stock pass and passConfirm
            if($key == 'pass' OR $key == 'passConfirm')
            {
                $stock = $key.'Stock';
                $this->$stock = $post[$key];
            }

            if($this->$key->check($post[$key]))
            {
                $this->message[$key] = $this->$key->check($post[$key]);
            }
        }

        //Compare pass and passConfirm
        if($this->passStock !== $this->passConfirmStock)
        {
            $this->message['passConfirm'] = 'Les mots de passe sont différents.';
        }

        if($this->message != [])
        {
            return $this->message;
        }
    }
}