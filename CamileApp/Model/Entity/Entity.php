<?php


namespace CamileApp\Model\Entity;


class Entity
{
    protected $id;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        if(is_int($id) && $id > 0)
        {
            $this->id = $id;
        }
        throw new Exception('typage');
    }

    /**
     * change de format of the date
     * @param $date_action
     * @param $date
     */
    protected function setDate($date_action, $date)
    {
        if(!is_null($date))
        {
            $this->$date_action = $date;
        }

        if(is_string($this->$date_action))
        {
            $newDateFormat = date("d/m/Y à H:i", strtotime($this->$date_action));
            $this->$date_action = $newDateFormat;
        }
    }
}