<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\SectorResource\Pages;
use App\Models\Sector;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SectorResource extends Resource
{
    protected static ?string $model = Sector::class;

    protected static ?string $modelLabel = 'sector';

    protected static ?string $pluralModelLabel = 'sectores';

    protected static ?string $slug = 'sectores';

    protected static ?string $navigationIcon = 'heroicon-s-map';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nombre')
                    ->required(),
                Forms\Components\Radio::make('group')
                    ->label('Ubicación')
                    ->columnStart(1)
                    ->options([
                        'urbano' => 'Urbano',
                        'rural' => 'Rural',
                    ])
                    ->required(),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable(),
            ])
            ->groups([
                Tables\Grouping\Group::make('group')
                    ->label('Ubicación')
                    ->getTitleFromRecordUsing(fn (Sector $record): string => ucfirst($record->group))
                    ->collapsible(),
            ])
            ->defaultGroup('group')
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageSectors::route('/'),
        ];
    }
}
