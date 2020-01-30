<?php


namespace CamileApp\Core\Constraints\ValidationForm;


/**
 * Class CommentsValidationForm
 * @package CamileApp\Core\Constraints
 */
class CommentsValidationForm extends ValidationForm
{
    protected $content;
    protected $keys = ['content'];

    public function __construct()
    {
        foreach($this->keys as $key)
        {
            $field = 'CamileApp\\Core\\Constraints\\ValidationForm\\Field\\'.ucfirst($key).'Field';
            $this->$key = new $field();
        }

//change $min and $max of content field, because the value for comment's content is different than the value of post's content
        $this->content->setMin(1);
        $this->content->setMax(5000);
    }
}