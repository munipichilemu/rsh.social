<?php

namespace App\Filament\Admin\Widgets;

use Filament\Widgets\ChartWidget;

class AtencionesDiarias extends ChartWidget
{
    protected static ?string $heading = 'Atenciones Diarias';

    protected function getData(): array
    {
        return [
            //
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
