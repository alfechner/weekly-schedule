<?php

namespace Alf\WeeklySchedule\Table;

class Table
{

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

    public function removeRow(Row $row)
    {
        $index = $row->getIndex();
        unset($this->rows[$index]);
    }

    public function getRows()
    {
        return $this->rows;
    }

    public function removeEmptyRows()
    {
        foreach ($this->getRows() as $row) {
            if ($this->isRowEmpty($row)) {
                $this->removeRow($row);
            }
        }
    }

    public function isRowEmpty(Row $row)
    {
        foreach ($this->getColumns() as $column) {
            if ($column->isRowIndexOccupied($row->getIndex())) {
                return false;
            }
        }

        return true;
    }
}