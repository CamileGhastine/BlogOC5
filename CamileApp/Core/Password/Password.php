<?php

namespace CamileApp\Core\Password;

/**
 * Class Password
 * @package CamileApp\Core\Password
 */
class Password
{
    /**
     * Hash the password
     * @param $pass
     * @return bool|string
     */
    public function hash($pass)
    {
        return password_hash($this->salt($pass), PASSWORD_DEFAULT);
    }

    /**
     * Compare the password with the hash
     * @param $pass
     * @param $hash
     * @return bool
     */
    public function verify($pass, $hash)
    {
        return password_verify($this->salt($pass), $hash);
    }

    /**
     * Salt the password before hashing
     * @param $pass
     * @return string
     */
    public function salt($pass)
    {
        return $pass . '@camileGHASTINE@';

    }
}