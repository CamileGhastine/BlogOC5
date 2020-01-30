<?php


namespace CamileApp\Core\Constraints\ValidationForm\Field;


/**
 * Class PassField
 * @package CamileApp\Core\Constraints\ValidationForm\Field
 */
class PassField extends Field
{
    protected $max = 50;

    protected $pass;

    public function check( $pass)
    {
        if($this->checkLength($pass))
        {
            return $this->checkLength($pass);
        }

        // check if the field has 6 caracters and at least 1 letter and 1 number
        if(!preg_match('#(?=.*[0-9])(?=.*[a-zA-Z]).{6,}$#', $pass))
        {
            return 'Le mot de passe doit comporter 6 caratères avec au moins 1 chiffre et 1 lettre.';
        }
    }
}