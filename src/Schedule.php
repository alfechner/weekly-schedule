<?php

namespace Alf\WeeklySchedule;

use Alf\WeeklySchedule\Renderer\AbstractRenderer;
use Alf\WeeklySchedule\Renderer\HtmlRenderer;
use Alf\WeeklySchedule\Table\Table;
use Alf\WeeklySchedule\Week\Week;

class Schedule {

    protected $renderStrategy;

    function __construct()
    {
        $this->renderStrategy = $this->getDefaultRenderStrategy();
    }

    protected function getDefaultRenderStrategy()
    {
        return new HtmlRenderer();
    }

    public function setRenderStrategy(AbstractRenderer $renderStrategy = NULL)
    {
        if (NULL === $renderStrategy) {
            $renderStrategy = $this->getDefaultRenderStrategy();
        }

        $this->renderStrategy = $renderStrategy;
    }

    public function render($week)
    {
        $renderStrategy = $this->renderStrategy;
        $table = $this->getTableFromWeek($week);
        $output = $renderStrategy->renderTable($table);

        return $output;
    }

    protected function getTableFromWeek(Week $week)
    {
        $table = new Table();

        $transformer = new WeekToTableTransformer();
        $transformer->transform($week, $table);

        return $table;
    }
}