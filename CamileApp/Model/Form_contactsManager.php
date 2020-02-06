<?php


namespace CamileApp\Model;


class Form_contactsManager extends Manager
{
    protected $table = 'form_contacts';

    public function add($post)
    {
        $sql = 'INSERT INTO form_contacts(first_name, last_name, email, subject, content, user_id) VALUES (:first_name, :last_name, :email, :subject, :content, :user_id)';
        return $this->db->request($sql, $post);
    }

}