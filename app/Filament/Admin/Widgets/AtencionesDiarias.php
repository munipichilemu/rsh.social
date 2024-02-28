<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Atencion;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Illuminate\Contracts\Support\Htmlable;

class AtencionesDiarias extends ChartWidget
{
    public function getHeading(): string|Htmlable|null
    {
        return 'Atenciones en '.ucwords(now()->translatedFormat('F Y'));
    }

    protected static ?int $sort = 2;

    protected int|string|array $columnSpan = 'full';

    protected static ?string $maxHeight = '300px';

    protected function getData(): array
    {
        $trend = Trend::model(Atencion::class)
            ->between(
                start: now()->startOfMonth(),
                end: now()->endOfMonth()
            )
            ->perDay()
            ->count();

        return [
            'datasets' => [
                [
                    'label' => ucwords(now()->translatedFormat('F Y')),
                    'data' => $trend->map(fn (TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $trend->map(fn (TrendValue $value) => Carbon::parse($value->date)->translatedFormat('d M')),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
