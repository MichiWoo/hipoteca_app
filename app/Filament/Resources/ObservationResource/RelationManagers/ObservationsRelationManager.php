<?php

namespace App\Filament\Resources\ObservationResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class ObservationsRelationManager extends RelationManager
{
    protected static string $relationship = 'observations';

    protected static ?string $modelLabel = 'Observación';

    protected static ?string $pluralModelLabel = 'Observaciones';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('texto')
                    ->required()
                    ->maxLength(255),
                DatePicker::make('fecha')
                    ->default(date('Y-m-d'))
                    ->required()
                    ->format('Y-m-d'),
                TextInput::make('user_id')
                    ->default(Auth::user()->id)
                    ->readOnly()
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('texto')
            ->columns([
                TextColumn::make('texto'),
                TextColumn::make('fecha'),
                TextColumn::make('user.name'),
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
