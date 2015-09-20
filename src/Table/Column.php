<?php

namespace Alf\WeeklySchedule\Table;

use Alf\WeeklySchedule\Exception\WeeklyScheduleException;

class Column {

    const OCCUPIED_BY_CELL_HEIGHT = 'occupied';

    protected $index;
    protected $label;
    /** @var Cell[] $cells */
    protected $cells = array();

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

    public function addCellForRow(Cell $cell, Row $row)
    {
        $this->tryAddCellForRow($cell, $row);
        $this->tryOccupyNeededRows($cell, $row);
    }

    protected function tryAddCellForRow(Cell $cell, Row $row)
    {
        $rowIndex = $row->getIndex();
        if ($this->isRowIndexOccupied($rowIndex)) {
            $this->throwOccupiedException();
        }

        $this->cells[$rowIndex] = $cell;
    }

    protected function isRowIndexOccupied($rowIndex)
    {
        if (array_key_exists($rowIndex, $this->cells)) {
            return true;
        }

        return false;
    }

    protected function tryOccupyNeededRows(Cell $cell, Row $row)
    {
        $height = $cell->getHeight();
        $rowIndex = $row->getIndex();

        $first = $rowIndex + 1;
        $last = $rowIndex + $height - 1;

        for ($i = $first; $i <= $last; $i++) {
            $this->tryOccupyRowByIndex($i);
        }
    }

    protected function tryOccupyRowByIndex($rowIndex)
    {
        if ($this->isRowIndexOccupied($rowIndex)) {
            $this->throwOccupiedException();
        }

        $this->cells[$rowIndex] = self::OCCUPIED_BY_CELL_HEIGHT;
    }

    protected function throwOccupiedException()
    {
        throw new WeeklyScheduleException('Overlapping sessions, row is already occupied');
    }

    public function getCells()
    {
        return $this->cells;
    }

    public function getCellContentByRow(Row $row)
    {
        $rowIndex = $row->getIndex();
        $content = array();

        if ($this->isRowIndexOccupied($rowIndex)) {
            $cell = $this->cells[$rowIndex];
            if ($cell instanceof Cell) {
                $content = $cell->getContent();
            }
        }

        return $content;
    }

    protected function isOccupiedByCellHeight($cell)
    {
        return $cell === self::OCCUPIED_BY_CELL_HEIGHT;
    }

    protected function isNotOccupiedByCellHeight($cell)
    {
        return $this->isOccupiedByCellHeight($cell);
    }

    public function renderCellForRow(Row $row) {
        $rowIndex = $row->getIndex();

        if ($this->isRowIndexOccupied($rowIndex)) {
            $cell = $this->cells[$rowIndex];
            if ($this->isOccupiedByCellHeight($cell)) {
                return false;
            }
        }

        return true;
    }

    public function getRowspanForRow(Row $row)
    {
        $rowIndex = $row->getIndex();

        if ($this->isRowIndexOccupied($rowIndex)) {
            $cell = $this->cells[$rowIndex];
            if ($cell instanceof Cell) {
                return $cell->getHeight();
            }
        }

        return 1;
    }
}