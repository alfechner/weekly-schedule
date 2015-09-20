<?php

namespace Alf\WeeklySchedule\Week;

use DateTime;

class Session
{
    protected $from;
    protected $till;
    protected $content;

    function __construct(DateTime $from, DateTime $till, array $content)
    {
        /** @var DateTime from */
        $this->from = $from;

        /** @var DateTime till */
        $this->till = $till;
        $this->content = $content;
    }

    public function getFrom()
    {
        return $this->from;
    }

    public function getTill()
    {
        return $this->till;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getDuration()
    {
        return $this->getTill()->diff($this->getFrom());
    }
}