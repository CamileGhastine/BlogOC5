<?php


namespace CamileApp\Core\Constraints\ValidationForm;


/**
 * Class CategoriesValidationForm
 * @package CamileApp\Core\Constraints
 */
class CategoriesValidationForm extends ValidationForm
{
    protected $name;
    protected $description;
    protected $keys = ['name', 'description'];
}