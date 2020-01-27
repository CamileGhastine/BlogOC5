<?php


namespace CamileApp\Model;


class UsersManager extends Manager
{
    protected $table = 'users';

    /**
     * Check if the pseudo exists
     * function request($sql, $param, $table, $fetchall)
     * @param $pseudo
     */
    public function exists($field, $value)
    {
        $sql = 'SELECT COUNT(*) FROM users WHERE '.$field.'=:value';
        return $this->db->request($sql, ['value' => $value], null, false);
    }

    /**
     * INSERT INTO request
     * @return mixed
     */
    public function add($param)
    {
        $sql = 'INSERT INTO users(pseudo, email, pass) VALUES (:pseudo, :email, :pass)';
        return $this->db->request($sql, $param, 'users');
    }


}