<?php


namespace CamileApp\Core\Constraints;


class CommentsValidationForm
{
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