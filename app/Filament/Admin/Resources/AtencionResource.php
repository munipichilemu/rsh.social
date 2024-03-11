<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\AtencionResource\Pages;
use App\Models\Atencion;
use App\Models\Sector;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Laragear\Rut\Rut;
use Malzariey\FilamentDaterangepickerFilter\Filters\DateRangeFilter;
use Parfaitementweb\FilamentCountryField\Forms\Components\Country;
use Ysfkaya\FilamentPhoneInput\Forms\PhoneInput;
use Ysfkaya\FilamentPhoneInput\PhoneInputNumberType;
use Ysfkaya\FilamentPhoneInput\Tables\PhoneColumn;

class AtencionResource extends Resource
{
    protected static ?string $model = Atencion::class;

    protected static ?string $modelLabel = 'atención';

    protected static ?string $pluralModelLabel = 'atenciones';

    protected static ?string $slug = 'atenciones';

    protected static ?string $navigationIcon = 'heroicon-s-document-check';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Datos del beneficiario')
                    ->description('Datos básicos de identificación del beneficiario')
                    ->schema([
                        Forms\Components\TextInput::make('rut')
                            ->label('RUT')
                            ->rules(['rut'])
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (Set $set, ?string $state) => strlen($state) > 3 ? $set('rut', Rut::parse($state)->format()) : $state)
                            ->formatStateUsing(fn (?string $state): string => $state ?? '')
                            ->disabled(fn (string $context): bool => $context === 'edit')
                            ->validationAttribute('rut')
                            ->required(),

                        Forms\Components\TextInput::make('names')
                            ->label('Nombres')
                            ->columnStart(1)
                            ->required(),
                        Forms\Components\TextInput::make('lastname_1')
                            ->label('Primer Apellido')
                            ->required(),
                        Forms\Components\TextInput::make('lastname_2')
                            ->label('Segundo Apellido'),

                        Country::make('nationality')
                            ->label('Nacionalidad')
                            ->default('CL')
                            ->searchable()
                            ->required(),
                        PhoneInput::make('phone')
                            ->defaultCountry('CL')
                            ->disallowDropdown()
                            ->showSelectedDialCode(true)
                            ->inputNumberFormat(PhoneInputNumberType::E164)
                            ->formatAsYouType(),

                        Forms\Components\Textarea::make('address')
                            ->label('Dirección')
                            ->columnSpan(2)
                            ->rows(3)
                            ->required(),
                        Forms\Components\Select::make('sector_id')
                            ->label('Sector')
                            ->relationship('sector', 'name')
                            ->searchable()
                            ->options(
                                Sector::all()
                                    ->groupBy('group')
                                    ->map(fn ($group) => $group->mapWithKeys(fn ($item) => [$item['id'] => $item['name']]))
                                    ->mapWithKeys(fn ($item, $key) => [ucfirst($key) => $item]))
                            ->preload()
                            ->nullable()
                            ->required(),
                    ])
                    ->columns(3),

                Forms\Components\Section::make('Detalles de atención')
                    ->description('Trámites realizados durante la sesión de atención')
                    ->schema([
                        Forms\Components\Select::make('tramite_id')
                            ->label('Tramite realizado')
                            ->columnSpan(2)
                            ->relationship('tramite', 'name')
                            ->searchable()
                            ->preload()
                            ->nullable()
                            ->required(),
                        Forms\Components\DatePicker::make('created_at')
                            ->label('Fecha atención')
                            ->maxDate(today()),
                        Forms\Components\MarkdownEditor::make('annotations')
                            ->label('Notas')
                            ->disableToolbarButtons([
                                'attachFiles',
                                'blockquote',
                                'codeBlock',
                                'heading',
                                'table',
                            ])
                            ->columnSpanFull(),
                    ])
                    ->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('names')
                    ->label('Beneficiario')
                    ->formatStateUsing(fn (?Atencion $record): string => "$record->names $record->lastname_1 $record->lastname_2")
                    ->description(fn (?Atencion $record): string => $record->rut)
                    ->searchable(['rut_num', 'names', 'lastname_1', 'lastname_2']),
                Tables\Columns\TextColumn::make('tramite.name')
                    ->label('Trámite realizado'),
                Tables\Columns\TextColumn::make('sector.name')
                    ->label('Sector')
                    ->toggleable(isToggledHiddenByDefault: true),
                PhoneColumn::make('phone')
                    ->label('Teléfono')
                    ->displayFormat(PhoneInputNumberType::INTERNATIONAL)
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('nationality')
                    ->label('Nacionalidad')
                    ->formatStateUsing(fn (string $state): string => (new Country('list'))->getList()[$state])
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Atendido el')
                    ->date('d M Y')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('tramite_id')
                    ->label('Trámite realizado')
                    ->relationship('tramite', 'name')
                    ->searchable()
                    ->preload(),
                DateRangeFilter::make('created_at')
                    ->label('Fecha de atención')
                    ->withIndicator(),
                Tables\Filters\SelectFilter::make('sector_id')
                    ->label('Sector beneficiario')
                    ->relationship('sector', 'name')
                    ->searchable()
                    ->preload(),
            ])
            ->filtersTriggerAction(fn (Tables\Actions\Action $action) => $action->button()->label('Filtros'))
            ->toggleColumnsTriggerAction(fn (Tables\Actions\Action $action) => $action->button()->label('Columnas'))
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
            'index' => Pages\ListAtencions::route('/'),
            'create' => Pages\CreateAtencion::route('/create'),
            'edit' => Pages\EditAtencion::route('/{record}/edit'),
        ];
    }
}
