<?php

namespace App\Filament\Resources;

use App\Enums\ExpedientStatus;
use App\Enums\ViviendaType;
use App\Filament\Resources\ExpedientResource\Pages;
use App\Filament\Resources\ExpedientResource\RelationManagers;
use App\Filament\Resources\HolderResource\RelationManagers\HoldersRelationManager;
use App\Filament\Resources\ObservationResource\RelationManagers\ObservationsRelationManager;
use App\Filament\Resources\ProcedureResource\RelationManagers\ProceduresRelationManager;
use App\Models\Bank;
use App\Models\Expedient;
use DateTime;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
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
                    ->default(date('Y-m-d'))
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
                    ->default(date('Y-m-d'))
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
                    ->maxLength(255),
                Fieldset::make('borrow_id')
                    ->relationship('borrow')
                    ->label(('Préstamo'))
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
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->emptyStateHeading('No hay Expedientes')
            ->columns([
                TextColumn::make('id')
                    ->tooltip('Número de Expediente')
                    ->label('No. Exp.'),
                TextColumn::make('holders.nombre')
                    ->label('Titular(es)')
                    ->listWithLineBreaks()
                    ->limitList(2),
                TextColumn::make('fecha')
                    ->tooltip('Fecha de Recepción')
                    ->label('Fecha Rec.')
                    ->sortable(),
                TextColumn::make('user.name')
                    ->weight(FontWeight::Bold),
                TextColumn::make('telefono1')
                    ->label('Teléfono'),
                TextColumn::make('localidad')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('provincia')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('tipo')
                    ->badge()
                    ->label('Operación'),
                TextColumn::make('banco')
                    ->searchable(),
                TextColumn::make('estado')
                    ->badge(),
            ])
            ->filters([
                SelectFilter::make('tipo')
                    ->options(ExpedientStatus::class)
            ])
            ->actions([
                ActionGroup::make([
                    EditAction::make(),
                    ViewAction::make(),
                    DeleteAction::make(),
                    Action::make('Borrar Préstamo')
                        ->icon('heroicon-o-credit-card')
                        ->color('danger')
                        ->modalHeading('Préstamo')
                        ->modalSubmitActionLabel('¿Desea borrar el préstamo?')
                        ->successNotificationTitle('Préstamo borrado')
                        ->requiresConfirmation()
                        ->action(function (Expedient $record){
                            $record->borrow()->delete();
                        })
                        ->visible(fn (Expedient $record): bool =>  !is_null($record->borrow)),
                ])
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
            ObservationsRelationManager::class,
            HoldersRelationManager::class,
            ProceduresRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListExpedients::route('/'),
            'create' => Pages\CreateExpedient::route('/create'),
            'view' => Pages\ViewExpedient::route('/{record}'),
            'edit' => Pages\EditExpedient::route('/{record}/edit'),
        ];
    }
}
