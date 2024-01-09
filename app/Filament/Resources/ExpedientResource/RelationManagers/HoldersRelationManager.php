<?php

namespace App\Filament\Resources\ExpedientResource\RelationManagers;

use App\Enums\ContratoType;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HoldersRelationManager extends RelationManager
{
    protected static string $relationship = 'holders';

    protected static ?string $modelLabel = 'Titular';

    protected static ?string $pluralModelLabel = 'Titulares';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nombre')
                    ->required()
                    ->maxLength(255),
                TextInput::make('edad'),
                TextInput::make('dni'),
                TextInput::make('empleo'),
                Select::make('tipo_contrato')
                    ->options(ContratoType::class),
                TextInput::make('antiguedad'),
                TextInput::make('salario'),
                TextInput::make('pagos'),
                TextInput::make('renta'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('nombre')
            ->columns([
                TextColumn::make('nombre'),
                TextColumn::make('edad'),
                TextColumn::make('dni'),
                TextColumn::make('empleo'),
                TextColumn::make('tipo_contrato')
                    ->badge(),
                TextColumn::make('antiguedad'),
                TextColumn::make('salario'),
                TextColumn::make('pagos'),
                TextColumn::make('renta'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
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
}
