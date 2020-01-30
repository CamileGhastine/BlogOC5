<?php


namespace CamileApp\Core\Constraints\ValidationForm\Field;


/**
 * Class ChapoField
 * @package CamileApp\Core\Constraints\ValidationForm\Field
 */
class ChapoField extends Field
{
    protected $min = 2;
    protected $max = 255;

    public function check($name)
    {
        if($this->checkLength($name))
        {
            return $this->checkLength($name);
        }
    }
}