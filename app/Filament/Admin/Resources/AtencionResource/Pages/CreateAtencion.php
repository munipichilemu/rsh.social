<?php

namespace App\Filament\Admin\Resources\AtencionResource\Pages;

use App\Filament\Admin\Resources\AtencionResource;
use Filament\Resources\Pages\CreateRecord;

class CreateAtencion extends CreateRecord
{
    protected static string $resource = AtencionResource::class;

    protected static bool $canCreateAnother = false;

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
