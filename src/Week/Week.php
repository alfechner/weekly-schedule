<?php

namespace Alf\WeeklySchedule\Week;

class Week
{
    protected $days = array();

    public function addDay(Day $day)
    {
        $this->days[$day->getNumberInWeek()] = $day;
    }

    public function getDays()
    {
        ksort($this->days);
        return $this->days;
    }

    public function getAllSessionsOfWeek()
    {
        $sessionsInWeek = array();

        /** @var Day $day*/
        foreach($this->days as $day)
        {
            $sessionsOfDay = $day->getSessions();
            $sessionsInWeek = array_merge($sessionsInWeek, $sessionsOfDay);
        }

        return $sessionsInWeek;
    }

    public function getEarliestSessionOfWeek()
    {
        $sessionsOfWeek = $this->getAllSessionsOfWeek();
        /** @var Session $earliestSession */
        $earliestSession = $sessionsOfWeek[0];

        /** @var Session $session */
        foreach($sessionsOfWeek as $session)
        {
            $from = $session->getFrom();

            if ($from < $earliestSession->getFrom()) {
                $earliestSession = $session;
            }
        }

        return $earliestSession;
    }

    public function getLatestSessionOfWeek()
    {
        $sessionsOfWeek = $this->getAllSessionsOfWeek();
        /** @var Session $latestSession */
        $latestSession = $sessionsOfWeek[0];

        /** @var Session $session */
        foreach($sessionsOfWeek as $session)
        {
            $till = $session->getTill();

            if ($till >= $latestSession->getTill()) {
                $latestSession = $session;
            }
        }

        return $latestSession;
    }
}