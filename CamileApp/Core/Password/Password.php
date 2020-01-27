<?php


namespace CamileApp\Core\Password;


class Password
{
    public function hash($pass)
    {
        $pass .='@camileGHASTINE@';
        return password_hash($pass, PASSWORD_DEFAULT);
    }
}