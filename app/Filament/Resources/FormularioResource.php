<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FormularioResource\Pages;
use App\Filament\Resources\FormularioResource\RelationManagers;
use App\Models\Formulario;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FormularioResource extends Resource
{
    protected static ?string $model = Formulario::class;

    protected static ?string $navigationIcon = 'heroicon-o-paper-airplane';

    protected static ?string $modelLabel = 'Formulario';

    protected static ?string $pluralModelLabel = 'Formularios';

    protected static ?string $navigationGroup = 'Clientes';

    //protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nombre')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('mensaje')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('telefono')
                    ->searchable()
                    ->sortable()
                    ->label('Teléfono'),
                TextColumn::make('ip')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('fecha')
                    ->searchable()
                    ->sortable(),
                IconColumn::make('movil')
                    ->boolean()
                    ->label('Móvil'),
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
            'index' => Pages\ListFormularios::route('/'),
            'create' => Pages\CreateFormulario::route('/create'),
            'edit' => Pages\EditFormulario::route('/{record}/edit'),
        ];
    }
}
