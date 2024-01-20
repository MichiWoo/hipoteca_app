<?php

namespace App\Filament\Resources\ExpedientResource\RelationManagers;

use App\Enums\BankStatus;
use App\Models\Bank;
use Filament\Forms;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class ProceduresRelationManager extends RelationManager
{
    protected static string $relationship = 'procedures';

    protected static ?string $modelLabel = 'Trámite';

    protected static ?string $pluralModelLabel = 'Trámites';

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
                    ->default(1),
                Repeater::make('comments')
                    ->relationship()
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
                    ])
                    ->itemLabel(fn (array $state): ?string => $state['texto'] ?? null)
                    ->collapsed()
                    ->collapseAllAction(
                        fn (Action $action) => $action->label('Colpasar todos los comentarios'),
                    )
                    ->deleteAction(
                        fn (Action $action) => $action->requiresConfirmation(),
                    )
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
                TextColumn::make('bank.nombre')
                    ->label('Bancos'),
                TextColumn::make('comments.texto')
                    ->listWithLineBreaks()
                    ->label('Comentarios'),
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
