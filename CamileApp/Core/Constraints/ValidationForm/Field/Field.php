<?php


namespace CamileApp\Core\Constraints\ValidationForm\Field;


/**
 * Class Field
 * @package CamileApp\Core\Constraints\ValidationForm\Field
 */
class Field
{
    /**
     * minimum length allow
     * @var int
     */
    protected $min=0;
    /**
     * Maximum length allow
     * @var null
     */
    protected $max = null;

    /**
     * check if there is a space in first or in last position
     * @param $input
     * @return string
     */
    public function checkSpace($input)
    {
        if(preg_match('#(^\s|\s$)#', $input))
        {
            return 'Ce champs ne doit ni commencer ni finir par un espace.';
        }
    }

    /**
     * check if the fild is empty and it length
     * @param $input
     * @return string
     */
    public function checklength($input)
    {
        if(empty($input))
        {
            return 'Ce champs est obligatoire.';
        }

        if(strlen($input) < $this->min)
        {
            return 'Le champs saisi est trop court (minimum ' . $this->min . ' caractères).';
        }

        if($this->max !== null && strlen($input) > $this->max)
        {
            return 'Le champs saisi est trop long (maximum ' . $this->max . ' caractères).';
        }
    }

}