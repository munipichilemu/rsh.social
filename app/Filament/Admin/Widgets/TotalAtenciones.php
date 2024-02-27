<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Atencion;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Flowframe\Trend\Trend;

class TotalAtenciones extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $trend = Trend::model(Atencion::class)
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear()
            )
            ->perYear()
            ->count('created_at');

        return [
            BaseWidget\Stat::make(
                "Atenciones en {$trend->first()->date}",
                $trend->first()->aggregate
            ),
        ];
    }
}
