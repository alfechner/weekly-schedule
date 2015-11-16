<?php

namespace Alf\WeeklySchedule\Table;

class Row {

    protected $column;
    protected $dateTime;
    protected $index;

    function __construct($index, $dateTime)
    {
        $this->index = $index;
        $this->dateTime = $dateTime;
    }

    public function getIndex()
    {
        return $this->index;
    }

    public function getDateTime()
    {
        return $this->dateTime;
    }
}