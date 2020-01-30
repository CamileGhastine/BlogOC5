<?php


namespace CamileApp\Core\Constraints\ValidationForm\Field;


/**
 * Class PseudoField
 * @package CamileApp\Core\Constraints\ValidationForm\Field
 */
class PseudoField extends Field
{
    protected $min = 2;
    protected $max = 50;

    public function check($pseudo)
    {
        if($this->checkSpace($pseudo))
        {
            return $this->checkSpace($pseudo);
        }

        if($this->checkLength($pseudo))
        {
            return $this->checkLength($pseudo);
        }
    }
}



