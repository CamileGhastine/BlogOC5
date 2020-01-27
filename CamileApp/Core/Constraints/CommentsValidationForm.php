<?php


namespace CamileApp\Core\Constraints;


/**
 * Class CommentsValidationForm
 * @package CamileApp\Core\Constraints
 */
class CommentsValidationForm extends ValidationForm
{
    protected $keys=['content'];

    public function getConstraints($var)
    {
        $this->min = 3;

        switch($var)
        {
            case 'content' :
                $this->max = 5000;
                break;
        }
    }
}