<?php

namespace Alf\WeeklySchedule;

use Alf\WeeklySchedule\Table\Cell;
use Alf\WeeklySchedule\Table\Column;
use Alf\WeeklySchedule\Week\Week;
use Alf\WeeklySchedule\Week\Session;
use Alf\WeeklySchedule\Week\Day;
use Alf\WeeklySchedule\Table\Table;
use Alf\WeeklySchedule\Table\Row;
use SebastianBergmann\RecursionContext\InvalidArgumentException;
use DateInterval;

class WeekToTableTransformer {

    protected $timeStepInMinutes = 15;

    /** @var Week $week */
    protected $week;
    /** @var Table $table */
    protected $table;

    public function transform(Week $week)
    {
        $this->week = $week;
        $this->table = new Table();

        $this->transformWeekToTable();

        return $this->table;
    }

    protected function transformWeekToTable()
    {
        $this->addRowsToTable();
        $this->addColumnsToTable();

    }

    protected function addColumnsToTable()
    {
        $table = $this->table;
        $week = $this->week;
        $days = $week->getDays();

        foreach($days as $day)
        {
            $column = $this->createColumnFromDay($day);
            $table->addColumn($column);
        }
    }

    protected function createColumnFromDay(Day $day)
    {
        $index = $day->getNumberInWeek();
        $label = $day->getLabel();

        $column = new Column($index, $label);

        $this->addCellsFromDayToColumn($day, $column);
        return $column;
    }

    protected function addCellsFromDayToColumn(Day $day, Column $column)
    {
        $sessions = $day->getSessions();

        foreach ($sessions as $session) {
            $this->addCellsFromSessionToColumn($session, $column);
        }
    }

    protected function addCellsFromSessionToColumn(Session $session, Column $column)
    {
        $row = $this->findRowBySession($session);
        $height = $this->calculateHeight($session);

        $cell = new Cell($column, $row, $session->getContent());
        $cell->setHeight($height);

        $column->addCellForRow($cell, $row);
    }

    protected function findRowBySession(Session $session)
    {
        $table = $this->table;
        $rows = $table->getRows();
        $sessionStart = $session->getFrom();

        /** @var Row $row */
        foreach ($rows as $row) {
            $dateTime = $row->getDateTime();

            if ($dateTime == $sessionStart) {
                return $row;
            }
        }

        throw new InvalidArgumentException('Could not find any fitting row for ' . $session->getFrom()->format('H:i:s'));
    }

    protected function calculateHeight(Session $session)
    {
        $duration = $session->getDuration();

        $differenceInMinutes = $duration->days * 24 * 60;
        $differenceInMinutes += $duration->h * 60;
        $differenceInMinutes += $duration->i;

        $height = $differenceInMinutes / $this->timeStepInMinutes;

        return $height;

    }

    protected function addRowsToTable()
    {
        $week = $this->week;
        $table = $this->table;

        $startDateTime = $week->getEarliestSessionOfWeek()->getFrom();
        $endDateTime = $week->getLatestSessionOfWeek()->getTill();
        $index = 0;

        do {
            $currentRow = new Row($index, $startDateTime);
            $table->addRow($currentRow);
            $index++;
            $startDateTime = clone $startDateTime;
            $this->addMinutesToDateTime($startDateTime);
        } while ($startDateTime < $endDateTime);
    }

    protected function addMinutesToDateTime(\DateTime $dateTime)
    {
        $minutes = $this->timeStepInMinutes;
        $dateTime->add(new DateInterval('PT' . $minutes . 'M'));
    }
}