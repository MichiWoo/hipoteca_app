<?php

namespace App\Filament\Resources;

use App\Enums\ExpedientStatus;
use App\Enums\ViviendaType;
use App\Filament\Resources\ExpedientResource\Pages;
use App\Filament\Resources\ExpedientResource\RelationManagers;
use App\Models\Expedient;
use Faker\Provider\ar_EG\Text;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ExpedientResource extends Resource
{
    protected static ?string $model = Expedient::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $modelLabel = 'Expediente';

    protected static ?string $pluralModelLabel = 'Expedientes';

    protected static ?int $navigationSort = 2;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                DatePicker::make('fecha')
                    ->required()
                    ->format('Y-m-d'),
                Select::make('tipo')
                    ->required()
                    ->options(ViviendaType::class),
                Toggle::make('vivienda')
                    ->required()
                    ->onColor('success')
                    ->offColor('danger'),
                Select::make('estado')
                    ->required()
                    ->options(ExpedientStatus::class),
                DatePicker::make('fecha_llamada')
                    ->required()
                    ->format('Y-m-d'),
                TextInput::make('telefono1')
                    ->required()
                    ->tel(),
                TextInput::make('telefono2')
                    ->tel(),
                TextInput::make('email')
                    ->required()
                    ->email(),
                TextInput::make('importe_compra')
                    ->required()
                    ->numeric(),
                TextInput::make('aportacion')
                    ->numeric(),
                TextInput::make('valor_aproximado')
                    ->numeric(),
                TextInput::make('importe_prestamo')
                    ->numeric(),
                TextInput::make('provincia')
                    ->maxLength(255),
                TextInput::make('localidad')
                    ->maxLength(255),
                TextInput::make('direccion')
                    ->maxLength(255)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('holder')
                    ->label('Titulares'),
                TextColumn::make('fecha')
                    ->label('Fecha Rec.'),
                TextColumn::make('user.name'),
                TextColumn::make('telefono1')
                ->label('Teléfono'),
                TextColumn::make('localidad'),
                TextColumn::make('provincia'),
                TextColumn::make('tipo')
                    ->badge()
                    ->label('Operación'),
                TextColumn::make('banco'),
                TextColumn::make('estado')
                    ->badge(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListExpedients::route('/'),
            'create' => Pages\CreateExpedient::route('/create'),
            'edit' => Pages\EditExpedient::route('/{record}/edit'),
        ];
    }
}
