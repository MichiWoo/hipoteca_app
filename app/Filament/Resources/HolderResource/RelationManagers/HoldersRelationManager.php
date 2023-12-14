<?php

namespace App\Filament\Resources\HolderResource\RelationManagers;

use App\Enums\ContratoType;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
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
                Tables\Columns\TextColumn::make('nombre'),
                Tables\Columns\TextColumn::make('edad'),
                Tables\Columns\TextColumn::make('dni'),
                Tables\Columns\TextColumn::make('empleo'),
                Tables\Columns\TextColumn::make('tipo_contrato')
                    ->badge(),
                Tables\Columns\TextColumn::make('antiguedad'),
                Tables\Columns\TextColumn::make('salario'),
                Tables\Columns\TextColumn::make('pagos'),
                Tables\Columns\TextColumn::make('renta'),
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
