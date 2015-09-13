<?php

namespace Alf\ScheduleTable\Renderer;

use Alf\ScheduleTable\Table;

interface AbstractRenderer {
    public function renderTable(Table $table);
}