<?php

namespace Alf\WeeklySchedule\Renderer;

use Alf\WeeklySchedule\Table\Table;

class HtmlRenderer implements AbstractRenderer {

    public function renderTable(Table $table)
    {
        $output = '<table>';
        $columns = $table->getColumns();
        $rows = $table->getRows();

        // <th>
        $output .= '<tr><td></td>';

        foreach ($columns as $column) {
            $output .= '<td>' . $column->getLabel() . '</td>';
        }

        $output .= '</tr>';

        // <tr>
        foreach ($rows as $row) {

            // time
            $output .= '<tr><td>';
            $output .= $row->getDateTime()->format('H:i:s');
            $output .= '</td>';

            foreach ($columns as $column) {
                if ($column->renderCellForRow($row)) {
                    $content = $column->getCellContentByRow($row);
                    $output .= '<td rowspan="' . $column->getRowspanForRow($row) . '">' . $this->getContentString($content) . '</td>';
                }
            }
            $output .= '</tr>';
        }

        $output .= '</table>';
        return $output;
    }

    protected function getContentString(array $content) {

        if (array_key_exists('title', $content)) {
            return $content['title'];
        }

        return '';
    }
}