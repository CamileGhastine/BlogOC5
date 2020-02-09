<?php


namespace CamileApp\Core\Constraints\ValidationForm;


class ChangePassValidationForm extends RegisterValidationForm
{
    protected $pass;
    protected $passConfirm;
    protected $oldPass;
    protected $keys = ['pass', 'passConfirm', 'oldPass'];


}