<?php


namespace CamileApp\Core\Constraints;


class Hijacking
{
    /**
     * Number of trying connexion allow before blocking the registered user account
     * @var int
     */
    const TRY=5;

    /**
     * @return mixed
     */
    public static function getTry()
    {
        return self::TRY;
    }
}