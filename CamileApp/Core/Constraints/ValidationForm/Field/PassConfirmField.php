<?php


namespace CamileApp\Core\Constraints\ValidationForm\Field;


/**
 * Class PassConfirmField
 * @package CamileApp\Core\Constraints\ValidationForm\Field
 */
class PassConfirmField extends Field
{

    public function check($name)
    {

        if($this->checkLength($name))
        {
            return $this->checkLength($name);
        }
    }
}