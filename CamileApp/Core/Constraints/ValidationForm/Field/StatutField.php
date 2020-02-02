<?php


namespace CamileApp\Core\Constraints\ValidationForm\Field;


class StatutField
{
    public function check($statut)
    {
        if($statut != 'user' AND $statut !='admin')
        {
            return 'Le statut n\'est pas valide.';
        }
    }
}