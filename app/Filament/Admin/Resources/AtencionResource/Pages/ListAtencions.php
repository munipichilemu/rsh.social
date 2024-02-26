<?php

namespace App\Filament\Admin\Resources\AtencionResource\Pages;

use App\Filament\Admin\Resources\AtencionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAtencions extends ListRecords
{
    protected static string $resource = AtencionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Registrar atención')
                ->icon('heroicon-s-document-plus'),
        ];
    }
}
