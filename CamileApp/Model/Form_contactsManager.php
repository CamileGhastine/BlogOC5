<?php


namespace CamileApp\Model;


class Form_contactsManager extends Manager
{
    protected $table = 'form_contacts';

    /**
     *all fomr_contacts in data base
     */
    public function allContact()
    {
        $sql = 'SELECT * FROM form_contacts ORDER BY date_submission DESC';
        return $this->db->request($sql, null, 'form_contacts', true);
    }
    /**
     * add form contact by user
     * @param $post
     * @return mixed
     */
    public function add($post)
    {
        $sql = 'INSERT INTO form_contacts(first_name, last_name, email, subject, content, user_id) VALUES (:first_name, :last_name, :email, :subject, :content, :user_id)';
        return $this->db->request($sql, $post);
    }


}