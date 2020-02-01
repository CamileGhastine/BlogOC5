<?php

namespace CamileApp\Model;

/**
 * Class UsersManager
 * @package CamileApp\Model
 */
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
     * substract 1 on avery flase password enter
     * @param $pseudo
     * @return mixed
     */
    public function substractTry($pseudo)
    {
        $sql = 'UPDATE users SET try=try+1 WHERE pseudo=:pseudo';
        return $this->db->request($sql, ['pseudo' => $pseudo], null, null);
    }

    /**
     * try come back to zero after a good connection
     * @param $pseudo
     * @return mixed
     */
    public function TryToZero($pseudo)
    {
        $sql = 'UPDATE users SET try=0 WHERE pseudo=:pseudo';
        return $this->db->request($sql, ['pseudo' => $pseudo], null, null);
    }

    /**
     * id, statut, hash pass and try for a pseudo
     * @param $pseudo
     * @return mixed
     */
    public function infoPseudo($pseudo)
    {
        $sql = 'SELECT id, pseudo, email, statut, date_inscription, pass, validated, try FROM users WHERE pseudo=:pseudo';
        return $this->db->request($sql, ['pseudo' => $pseudo], 'users', false);
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

    /**
     * all validated users
     * @return mixed
     */
    public function getValidated()
    {
        $sql ='SELECT * FROM users WHERE validated IS NOT NULL';
        return $this->db->request($sql, null, 'users', true);
    }


    /**
     * number of unvalidated users
     */
    public function countUnvalidated()
    {
        $sql ='SELECT COUNT(*) AS number FROM users WHERE validated IS NULL';
        return $this->db->request($sql, null, 'users', false);
    }
}