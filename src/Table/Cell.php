<?php

namespace Alf\ScheduleTable\Table;

class Cell
{
    protected $row;
    protected $column;
    protected $content;

    function __construct(Column $column, Row $row, $content)
    {
        $this->row = $row;
        $this->column = $column;
        $this->content = $content;
    }

    public function getColumn()
    {
        return $this->column;
    }

    public function getRow()
    {
        return $this->getRow();
    }
}



