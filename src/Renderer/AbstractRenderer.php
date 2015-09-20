<?php

namespace Alf\WeeklySchedule\Renderer;

use Alf\WeeklySchedule\Table\Table;

interface AbstractRenderer {
    public function renderTable(Table $table);
}