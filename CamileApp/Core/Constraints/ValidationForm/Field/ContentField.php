<?php


namespace CamileApp\Core\Constraints\ValidationForm\Field;


class ContentField extends Field
{
    protected $min = 2;
    protected $max;

    public function check($name)
    {
        if($this->checkLength($name))
        {
            return $this->checkLength($name);
        }
    }

    /**
     * @return int
     */
    public function getMin(): int
    {
        return $this->min;
    }

    /**
     * @param int $min
     */
    public function setMin(int $min): void
    {
        $this->min = $min;
    }

    /**
     * @return mixed
     */
    public function getMax()
    {
        return $this->max;
    }

    /**
     * @param mixed $max
     */
    public function setMax($max): void
    {
        $this->max = $max;
    }


}