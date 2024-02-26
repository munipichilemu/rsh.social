<?php

namespace App\Filament\Admin\Resources\SectorResource\Pages;

use App\Filament\Admin\Resources\SectorResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageSectors extends ManageRecords
{
    protected static string $resource = SectorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Agregar sector')
                ->icon('heroicon-s-map-pin')
                ->modalWidth('md')
                ->createAnother(false),
        ];
    }
}
