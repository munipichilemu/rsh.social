<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\TramiteResource\Pages;
use App\Models\Tramite;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TramiteResource extends Resource
{
    protected static ?string $model = Tramite::class;

    protected static ?string $modelLabel = 'trámite';

    protected static ?string $pluralModelLabel = 'trámites';

    protected static ?string $navigationIcon = 'heroicon-s-clipboard-document-list';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Trámite')
                    ->required(),
                Forms\Components\MarkdownEditor::make('description')
                    ->label('Descripción')
                    ->disableToolbarButtons([
                        'attachFiles',
                        'blockquote',
                        'codeBlock',
                        'heading',
                        'table',
                    ])
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->description(fn (Tramite $register): string => \Livewire\str((string) $register->description)->inlineMarkdown()->toHtmlString())
                    ->searchable(),
            ])
            ->filters([

            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->iconButton()
                    ->tooltip('Editar'),
                Tables\Actions\DeleteAction::make()
                    ->iconButton()
                    ->tooltip('Borrar'),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageTramites::route('/'),
        ];
    }
}
