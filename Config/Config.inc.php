<?php

Namespace Config;

class Config
{
    /**
     * config server database
     * @return array
     */
    public static function configDB()
    {
        return array(
            'db_host' => '',
            'db_name' => '',
            'db_user' => '',
            'db_pass' => '');
    }

    /**
     * Config server mail
     * @return array
     */
    public static function configMailer()
    {
        return array(
            'host' => 'mail.ghastine.com',
            'username' => 'camile@ghastine.com',
            'password' => 'CamileProjet5');
    }

    /**
     * Set here the number of try allow before lock user account to prevent hijacking attack
     * @return int
     */
    public static function configHijacking()
    {
        $numberOfTry = 5;
        return $numberOfTry;
    }
}