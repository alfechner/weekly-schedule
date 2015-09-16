<?php

namespace Alf\ScheduleTable\Week;

use Alf\ScheduleTable\ScheduleTableException;

class Day
{
    protected $englishName;
    protected $label;
    protected $numberOfDayInWeek;
    protected $sessions = array();

    function __construct($englishName, $label = NULL)
    {
        $this->englishName = $englishName;

        $this->label = $label
            ? $label
            : $englishName;
    }

    public function getLabel()
    {
        return $this->label;
    }

    public function getNumberInWeek()
    {
        if (!$this->numberOfDayInWeek) {
            $timestamp = $this->getTimestampFromEnglishDayName($this->englishName);
            $this->numberOfDayInWeek = $this->getNumberOfDayInWeekFromTimestamp($timestamp);
        }

        return $this->numberOfDayInWeek;
    }

    protected function getTimestampFromEnglishDayName($englishName)
    {
        $timestamp = strtotime($englishName);

        if (!$timestamp) {
            throw new ScheduleTableException('No valid format for day ' . $englishName);
        }

        return $timestamp;
    }

    protected function getNumberOfDayInWeekFromTimestamp($timestamp)
    {
        $numberOfDayInWeek = date('N', $timestamp);

        if (!$numberOfDayInWeek) {
            throw new ScheduleTableException('No valid format for timestamp ' . $timestamp);
        }

        return $numberOfDayInWeek;
    }

    public function addSession(Session $session)
    {
        $this->sessions[] = $session;
    }

    public function getSessions()
    {
        return $this->sessions;
    }
}