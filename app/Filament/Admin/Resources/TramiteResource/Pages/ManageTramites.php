<?php

namespace App\Filament\Admin\Resources\TramiteResource\Pages;

use App\Filament\Admin\Resources\TramiteResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ManageTramites extends ListRecords
{
    protected static string $resource = TramiteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->icon('heroicon-s-clipboard-document-list')
                ->createAnother(false),
        ];
    }
}
