<?php


namespace CamileApp\Core\Constraints\ValidationForm;


class ContactValidationForm extends ValidationForm
{
    protected $first_name;
    protected $last_name;
    protected $email;
    protected $subject;
    protected $content;
    protected $keys = ['first_name', 'last_name', 'email', 'subject', 'content'];

}