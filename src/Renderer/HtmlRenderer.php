<?php

namespace Alf\ScheduleTable\Renderer;

use Alf\ScheduleTable\Table;

class HtmlRenderer implements AbstractRenderer {

    public function renderTable(Table $table) {
        return '<table></table>';
    }
}