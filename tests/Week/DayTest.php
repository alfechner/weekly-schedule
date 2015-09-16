<?php

use \Alf\ScheduleTable\Week\Day;

class DayTest extends PHPUnit_Framework_TestCase
{
    public function testNumberOfDayInWeek()
    {
        $day = new Day('Monday', 'Montag');
        $numberOfDayInWeek = $day->getNumberInWeek();

        $this->assertEquals(1, $numberOfDayInWeek);
    }

    public function testDefaultDayLabel()
    {
        $englishName = 'Monday';
        $day = new Day($englishName);

        $this->assertEquals($englishName, $day->getLabel());
    }
}