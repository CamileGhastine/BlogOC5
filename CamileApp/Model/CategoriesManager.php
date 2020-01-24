<?php


namespace CamileApp\Model;
use \PDO;

/**
 * Class CategoriesManager
 * @package CamileApp\Model
 */
class CategoriesManager extends Manager
{
    /**
     * all categories
     * @return mixed
     */
    public function all()
    {
        $sql = 'SELECT * FROM categories';
        $req = $this->db->query($sql);
        $req->setFetchMode(PDO::FETCH_CLASS, 'CamileApp\Model\Entity\CategoriesEntity');
        return $req->fetchall();
    }

}