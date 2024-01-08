<?php

namespace App\Filament\Resources\ProcedureResource\RelationManagers;

use App\Enums\BankStatus;
use App\Models\Bank;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProceduresRelationManager extends RelationManager
{
    protected static string $relationship = 'Procedures';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('bank_id')
                    ->label('Banco')
                    ->options(Bank::all()->pluck('nombre', 'id')),
                DatePicker::make('fecha_presentacion')
                    ->required()
                    ->default(date('Y-m-d'))
                    ->format('Y-m-d'),
                DatePicker::make('fecha_resolucion')
                    ->required()
                    ->default(date('Y-m-d'))
                    ->format('Y-m-d')
                    ->nullable(),
                Select::make('estado')
                    ->options(BankStatus::class)
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('fecha_presentacion')
            ->columns([
                TextColumn::make('fecha_presentacion'),
                TextColumn::make('fecha_resolucion'),
                TextColumn::make('estado')
                    ->sortable()
                    ->badge(),
                TextColumn::make('bank.nombre'),
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
