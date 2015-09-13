<?php

namespace Alf\ScheduleTable\Table;

class Row {

    protected $cells = array();
    protected $column;

    public function addCell(Cell $cell)
    {
        $this->cells[] = $cell;
    }

    public function getCells()
    {
        return $this->cells;
    }

}