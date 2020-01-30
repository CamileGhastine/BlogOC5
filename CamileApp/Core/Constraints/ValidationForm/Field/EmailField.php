<?php


namespace CamileApp\Core\Constraints\ValidationForm\Field;


/**
 * Class EmailField
 * @package CamileApp\Core\Constraints\ValidationForm\Field
 */
class EmailField extends Field
{
    public function check($email)
    {
        if($this->checkLength($email))
        {
            return $this->checkLength($email);
        }

        if($this->checkSpace($email))
        {
            return $this->checkSpace($email);
        }

        // check is the field is an email
        if(!filter_var($email,FILTER_VALIDATE_EMAIL))
        {
            return 'Le format courriel n\'est pas valide.';
        }
    }
}