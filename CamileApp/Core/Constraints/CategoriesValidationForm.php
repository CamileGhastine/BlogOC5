<?php


namespace CamileApp\Core\Constraints;


/**
 * Class CategoriesValidationForm
 * @package CamileApp\Core\Constraints
 */
class CategoriesValidationForm extends ValidationForm
{
    public function getConstraints($var)
    {
        $this->min = 3;

        switch($var)
        {
            case 'name' :
                $this->max = 100;
                break;
            case 'description' :
                $this->max = 255;
                break;
        }
    }
}