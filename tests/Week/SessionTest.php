<?php

use \DateTime;
use \DateInterval;
use Alf\WeeklySchedule\Week\Session;

class SessionTest extends PHPUnit_Framework_TestCase
{
    public function testGetDuration()
    {
        $format = '%h';
        $durationInterval = new DateInterval('PT10H');
        $from = new DateTime('2000-01-01');
        $till = clone $from;
        $till->add($durationInterval);

        $session = $this->getSession($from, $till);
        $duration = $session->getDuration();

        $this->assertEquals($durationInterval->format($format), $duration->format($format));
    }

    protected function getSession(DateTime $from, DateTime $till)
    {
        $session = new Session($from, $till, array());
        return $session;
    }
}