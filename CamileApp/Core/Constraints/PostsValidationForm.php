<?php

namespace CamileApp\Core\Constraints;

/**
 * Class PostsValidationForm
 * @package CamileApp\Core\Constraints
 */
class PostsValidationForm extends ValidationForm
{
    public function getConstraints($var)
    {
        $this->min = 3;

        switch($var)
        {
            case 'title' :
                $this->max = 100;
                break;
            case 'chapo' :
                $this->max = 255;
                break;
            case 'content' :
                $this->max = null;
                break;
        }
    }
}
