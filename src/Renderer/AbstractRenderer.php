<?php

namespace Alf\ScheduleTable\Renderer;

use Alf\ScheduleTable\Table\Table;

interface AbstractRenderer {
    public function renderTable(Table $table);
}