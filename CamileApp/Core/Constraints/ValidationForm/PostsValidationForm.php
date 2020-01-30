<?php

namespace CamileApp\Core\Constraints\ValidationForm;


/**
 * Class PostsValidationForm
 * @package CamileApp\Core\Constraints
 */
class PostsValidationForm extends ValidationForm
{
    protected $title;
    protected $chapo;
    protected $content;
    protected $keys = ['title', 'chapo', 'content'];
}
