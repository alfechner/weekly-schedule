<?php

use \Alf\ScheduleTable\Week\Week;
use \Alf\ScheduleTable\Week\Day;
use \Alf\ScheduleTable\Week\Session;

require_once '../vendor/autoload.php';

class WeekTest extends PHPUnit_Framework_TestCase
{
    protected $week;
    protected $days;

    public function testNumberOfDays() {
        $days = $this->week->getDays();
        $this->assertCount(7, $days);
    }

    /**
     * @before
     */
    public function setupSession()
    {
        $this->week = new Week();

        $monday = $this->createDay('Monday', 'Montag');
        $tuesday = $this->createDay('Tuesday', 'Dienstag');
        $wednesday = $this->createDay('Wednesday', 'Mittwoch');
        $thursday = $this->createDay('Thursday', 'Donnerstag');
        $friday = $this->createDay('Friday', 'Freitag');
        $saturday = $this->createDay('Saturday', 'Samstag');
        $sunday = $this->createDay('Sunday', 'Sonntag');

        $monday->addSession($this->createSession('16:00:00', '17:00:00', 'Anfänger'));
        $monday->addSession($this->createSession('17:00:00', '18:30:00', 'Fortgeschirttene'));

        $tuesday->addSession($this->createSession('16:00:00', '17:30:00', 'Fortgeschirttene'));
        $tuesday->addSession($this->createSession('17:30:00', '19:00:00', 'Fortgeschirttene Wettkampf'));
        $tuesday->addSession($this->createSession('19:00:00', '21:00:00', 'Wettkampf'));

        $wednesday->addSession($this->createSession('16:00:00', '17:30:00', 'Fortgeschirttene ab 7 Jahren'));

        $thursday->addSession($this->createSession('16:00:00', '17:30:00', 'Fortgeschirttene'));
        $thursday->addSession($this->createSession('17:30:00', '19:00:00', 'Fortgeschirttene Wettkampf'));
        $thursday->addSession($this->createSession('19:00:00', '21:00:00', 'Wettkampf'));

        $days = array(
            $monday,
            $tuesday,
            $wednesday,
            $thursday,
            $friday,
            $saturday,
            $sunday
        );

        foreach($days as $day) {
            $this->week->addDay($day);
        }
    }

    protected function createDay($englishName, $label)
    {
        return new Day($englishName, $label);
    }

    protected function createSession($from, $till, $content)
    {
        $from = new DateTime($from);
        $till = new DateTime($till);

        $session = new Session($from, $till, array('title' => $content));

        return $session;
    }
}