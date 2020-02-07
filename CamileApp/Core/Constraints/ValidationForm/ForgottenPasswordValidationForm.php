<?php


namespace CamileApp\Core\Constraints\ValidationForm;


class ForgottenPasswordValidationForm extends ValidationForm
{
    protected $email;
    protected $keys = ['email'];
}