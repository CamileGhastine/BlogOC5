<?php


namespace CamileApp\Core\Password;


class Password
{
    public function hash($pass)
    {
        return password_hash($this->salt($pass), PASSWORD_DEFAULT);
    }

    public function verify($pass, $hash)
    {
        return password_verify($this->salt($pass), $hash);
    }

    public function salt($pass)
    {
        return $pass.'@camileGHASTINE@';

    }
}