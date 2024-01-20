<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ConexionResource\Pages;
use App\Filament\Resources\ConexionResource\RelationManagers;
use App\Models\Conexion;
use Filament\Actions\ActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;

class ConexionResource extends Resource
{
    protected static ?string $model = Conexion::class;

    protected static ?string $navigationIcon = 'heroicon-o-link';

    protected static ?string $modelLabel = 'Conexión';

    protected static ?string $pluralModelLabel = 'Conexiones';

    protected static ?string $navigationGroup = 'Clientes';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('ip')
                    ->required()
                    ->maxLength(30),
                DatePicker::make('fecha')
                    ->format('Y/m/d')
                    ->closeOnDateSelection(),
                Forms\Components\TextInput::make('pagina')
                    ->required()
                    ->maxLength(30),
                Toggle::make('movil')
                    ->onIcon('heroicon-m-device-phone-mobile')
                    ->offIcon('heroicon-m-computer-desktop'),
                Toggle::make('formulario')
                    ->onIcon('heroicon-m-paper-airplane')
                    ->offIcon('heroicon-m-face-frown'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('ip')
                    ->searchable()
                    ->sortable()
                    ->label('Dirección IP'),
                TextColumn::make('pagina')
                    ->searchable()
                    ->sortable()
                    ->label('Url visitada'),
                TextColumn::make('fecha')
                    ->searchable()
                    ->sortable(),
                IconColumn::make('movil')
                    ->boolean()
                    ->label('Móvil'),
                IconColumn::make('formulario')
                    ->boolean(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListConexions::route('/'),
            'create' => Pages\CreateConexion::route('/create'),
            'edit' => Pages\EditConexion::route('/{record}/edit'),
        ];
    }
}
