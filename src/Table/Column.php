<?php

namespace Alf\ScheduleTable\Table;

class Column {

    protected $rows = array();
    protected $index;
    protected $label;

    function __construct($index, $label)
    {
        $this->index = $index;
        $this->label = $label;
    }

    public function getIndex()
    {
        return $this->index;
    }

    public function getLabel()
    {
        return $this->label;
    }

    public function addRow(Row $row)
    {
        $this->rows[] = $row;
    }

    public function getRows()
    {
        return $this->rows;
    }

}