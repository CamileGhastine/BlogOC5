<?php


namespace CamileApp\Core\Constraints\ValidationForm\Field;


/**
 * Class TitleField
 * @package CamileApp\Core\Constraints\ValidationForm\Field
 */
class TitleField extends Field
{
    protected $min = 2;
    protected $max = 100;

    public function check($name)
    {

        if($this->checkSpace($name))
        {
            return $this->checkSpace($name);
        }

        if($this->checkLength($name))
        {
            return $this->checkLength($name);
        }
    }
}