<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Atencion;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Flowframe\Trend\Trend;

class IndicadoresAtenciones extends BaseWidget
{
    protected static ?int $sort = 1;

    /**
     * @param \Illuminate\Support\Collection $current_year
     * @param \Illuminate\Support\Collection $previous_year
     * @return float|int
     */
    public function calculateYearlyVariation(\Illuminate\Support\Collection $current_year, \Illuminate\Support\Collection $previous_year): int|float
    {
        if ($previous_year->first()->aggregate < 1) {
            return $current_year->first()->aggregate / 1;
        }

        return $current_year->first()->aggregate / $previous_year->first()->aggregate - 1;
    }

    protected function getStats(): array
    {
        $current_year = Trend::model(Atencion::class)
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear()
            )
            ->perYear()
            ->count();

        $previous_year = Trend::model(Atencion::class)
            ->between(
                start: now()->subYear(1)->startOfYear(),
                end: now()->subYear(1)
            )
            ->perYear()
            ->count();

        $variation_percentage = sprintf(
            '%+.2f',
            ($this->calculateYearlyVariation($current_year, $previous_year)) * 100
        );

        $tramites_ranking = Atencion::select('tramite_id', \DB::raw('count(*) as total'))
            ->whereBetween('created_at', [now()->startOfYear(), now()->endOfYear()])
            ->groupBy('tramite_id')
            ->orderBy('total', 'desc')
            ->with('tramite')
            ->get();

        return [
            BaseWidget\Stat::make('Atenciones realizadas', "{$current_year->first()->aggregate} atenciones")
                ->description("{$variation_percentage}% respecto al año anterior")
                ->descriptionIcon($variation_percentage > 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->color($variation_percentage > 0 ? 'success' : 'danger'),

            BaseWidget\Stat::make('Trámite más recurrente', "{$tramites_ranking->first()->tramite->name}")
                ->color('info')
                ->description("{$tramites_ranking->first()->total} atenciones durante este año"),
        ];
    }
}
