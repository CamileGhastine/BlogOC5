<?php


namespace CamileApp\Core\Constraints\ValidationForm;


class UsersValidationForm extends ValidationForm
{
    protected $pseudo;
    protected $pass;
    protected $email;
    protected $statut;
    protected $keys = ['pseudo', 'pass', 'email', 'statut'];
}