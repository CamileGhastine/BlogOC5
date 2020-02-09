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
     * Check if  $value exists in $field where id != $id
     * function request($sql, $param, $table, $fetchall)
     * @param $pseudo
     */
    public function exists($field, $value, $id = null)
    {
        if($id === null)
        {
            $sqlBis = null;
            $param = ['value' => $value];
        }
        else
        {
            $sqlBis = ' AND id <>:id';
            $param = ['value' => $value, 'id' => $id];
        }
        $sql = 'SELECT COUNT(*) AS pseudoExists FROM users WHERE ' . $field . '=:value' . $sqlBis;
        return $this->db->request($sql, $param, 'users', false);
    }

    /**
     * substract 1 on avery flase password enter
     * @param $pseudo
     * @return mixed
     */
    public function substractTry($pseudo)
    {
        $sql = 'UPDATE users SET try=try+1 WHERE pseudo=:pseudo';
        return $this->db->request($sql, ['pseudo' => $pseudo]);
    }

    /**
     * try come back to zero after a good connection
     * @param $pseudo
     * @return mixed
     */
    public function TryToZero($pseudo)
    {
        $sql = 'UPDATE users SET try=0 WHERE pseudo=:pseudo';
        return $this->db->request($sql, ['pseudo' => $pseudo]);
    }


    /**
     * id, statut, hash pass and try for a pseudo id
     * @param $id
     * @return mixed
     */
    public function infoPseudoWithId($id)
    {
        $sql = 'SELECT id, pseudo, email, statut, date_inscription, pass, validated, try FROM users WHERE id=:id';
        return $this->db->request($sql, ['id' => $id], 'users', false);
    }

    /**
     * id, statut, hash pass and try for a pseudo id
     * @param $id
     * @return mixed
     */
    public function infoPseudoWithPseudo($pseudo)
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
        $sql = 'INSERT INTO users(pseudo, email, pass, statut, validated) VALUES (:pseudo, :email, :pass, :statut, :validated)';
        return $this->db->request($sql, $param);
    }

    /**
     * all unvalidated users
     * @return mixed
     */
    public function getUnvalide()
    {
        $sql = 'SELECT * FROM users WHERE validated IS NULL ORDER BY pseudo';
        return $this->db->request($sql, null, 'users', true);
    }

    /**
     * all blocked user account
     * @return mixed
     */
    public function getUnactive()
    {
        $sql = 'SELECT * FROM users WHERE try >=5 ORDER BY pseudo';
        return $this->db->request($sql, null, 'users', true);
    }

    /**
     * number of unvalidated users
     */
    public function countUnvalidated()
    {
        $sql = 'SELECT COUNT(*) AS number FROM users WHERE validated IS NULL';
        return $this->db->request($sql, null, null, false);
    }

    /**
     *number of blocked users
     */
    public function countBlocked()
    {
        $sql = 'SELECT COUNT(*) AS number FROM users WHERE try>=5';
        return $this->db->request($sql, null, null, false);
    }

    /**
     * get all statuts
     */
    public function statut()
    {
        $sql = 'SELECT DISTINCT statut FROM users';
        return $this->db->request($sql, null, 'users', true);
    }

    /**
     * UPDATE request
     */
    public function update($param)
    {
        $sql = 'UPDATE users SET pseudo=:pseudo, email=:email, statut=:statut WHERE id=:id';
        return $this->db->request($sql, $param);
    }

    /**
     * Validate user
     */
    public function validate($param)
    {
        $sql = 'UPDATE users SET validated=1 WHERE id=:id';
        return $this->db->request($sql, $param);
    }

    /**
     * unlock user
     */
    public function activate($param)
    {
        $sql = 'UPDATE users SET try=0 WHERE id=:id';
        return $this->db->request($sql, $param);
    }

    /**
     * UPDATE password
     */
    public function updatePass($param)
    {
        $sql = 'UPDATE users SET pass=:pass WHERE id=:id';
        return $this->db->request($sql, $param);
    }
}