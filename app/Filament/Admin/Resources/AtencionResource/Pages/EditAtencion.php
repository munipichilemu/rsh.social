<?php

namespace App\Filament\Admin\Resources\AtencionResource\Pages;

use App\Filament\Admin\Resources\AtencionResource;
use Filament\Resources\Pages\EditRecord;

class EditAtencion extends EditRecord
{
    protected static string $resource = AtencionResource::class;

    protected function getHeaderActions(): array
    {
        return [

        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
