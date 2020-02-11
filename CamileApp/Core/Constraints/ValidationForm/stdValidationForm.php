<?php


namespace CamileApp\Core\Constraints\ValidationForm;


class stdValidationForm extends ValidationForm
{
    protected $name;
    protected $description;
    protected $pass;
    protected $passConfirm;
    protected $oldPass;
    protected $first_name;
    protected $last_name;
    protected $email;
    protected $subject;
    protected $content;
    protected $title;
    protected $chapo;
    protected $pseudo;
    protected $statut;
    protected $keys;

    public function __construct($keys)
    {
        $this->keys = $keys;
    }

}