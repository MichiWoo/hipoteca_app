<?php

namespace App\Filament\Resources\ExpedientResource\RelationManagers;

use App\Models\Bank;
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

class BorrowsRelationManager extends RelationManager
{
    protected static string $relationship = 'borrows';

    protected static ?string $modelLabel = 'Préstamo';

    protected static ?string $pluralModelLabel = 'Préstamos';

    protected static ?string $recordTitleAttribute = 'Préstamos';
    
    protected static ?string $title = 'Préstamos';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('tipo')
                    ->required()
                    ->maxLength(255),
                Select::make('bank_id')
                    ->options(Bank::all()->pluck('nombre', 'id'))
                    ->label('Entidad'),
                TextInput::make('inicial')
                    ->numeric(),
                TextInput::make('pendiente')
                    ->numeric(),
                TextInput::make('cuota')
                    ->numeric(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('tipo')
            ->columns([
                TextColumn::make('tipo'),
                TextColumn::make('bank.nombre')
                    ->label('Banco'),
                TextColumn::make('inicial'),
                TextColumn::make('pendiente'),
                TextColumn::make('cuota'),
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
