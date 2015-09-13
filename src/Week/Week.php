<?php

namespace Alf\ScheduleTable\Week;

class Week
{
    protected $days = array();

    public function addDay(Day $day)
    {
        $this->days[] = $day;
    }

    public function getDays()
    {
        return $this->days;
    }
}