<?php

namespace Alf\ScheduleTable\Table;

class Cell
{
    protected $row;
    protected $column;
    protected $content = array();
    protected $height = 1;

    function __construct(Column $column, Row $row, array $content)
    {
        $this->row = $row;
        $this->column = $column;
        $this->content = $content;
    }

    public function setHeight($height)
    {
        $this->height = $height;
    }

    public function getHeight()
    {
        return $this->height;
    }

    public function getColumn()
    {
        return $this->column;
    }

    public function getRow()
    {
        return $this->getRow();
    }

    public function getContent()
    {
        return $this->content;
    }
}



