<?php

namespace Alf\WeeklySchedule\Table;

class Table {

    /** @var Row[] $rows */
    protected $rows = array();
    /** @var Column[] $columns */
    protected $columns = array();

    public function addColumn(Column $column)
    {
        $index = $column->getIndex();
        $this->columns[$index] = $column;
    }

    public function getColumns()
    {
        return $this->columns;
    }

    public function addRow(Row $row)
    {
        $index = $row->getIndex();
        $this->rows[$index] = $row;
    }

    public function getRows()
    {
        return $this->rows;
    }
}