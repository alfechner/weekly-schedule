<?php

namespace Alf\ScheduleTable\Table;

class Table {

    protected $columns = array();

    public function addColumn(Column $column)
    {
        $this->columns[] = $column;
    }

    public function getColumns()
    {
        return $this->columns;
    }

}