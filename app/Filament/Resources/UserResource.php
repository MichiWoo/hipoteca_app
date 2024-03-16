<?php

namespace App\Filament\Resources;

use App\Enums\UserCategory;
use App\Enums\UserDepartament;
use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    
    protected static ?string $modelLabel = 'Usuario';

    protected static ?string $pluralModelLabel = 'Usuarios';

    protected static ?string $navigationGroup = 'Catálogos';

    //protected static ?int $navigationSort = 6;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label('Nombre'),
                Select::make('departamento')
                    ->options(UserDepartament::class),
                Select::make('categoria')
                    ->options(UserCategory::class),
                TextInput::make('email')
                    ->required()
                    ->maxLength(255),
                Select::make('roles')->multiple()->relationship('roles', 'name')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->label('Nombre'),
                TextColumn::make('departamento')
                    ->searchable()
                    ->sortable()
                    ->badge(),
                TextColumn::make('categoria')
                    ->searchable()
                    ->sortable()
                    ->badge(),
                TextColumn::make('email')
                    ->searchable()
                    ->sortable(),
                CheckboxColumn::make('email_verified_at')
                    ->beforeStateUpdated(function ($record, $state) {
                        // Runs before the state is saved to the database.
                        $state = !is_null($record->email_verified_at);
                    })
                    ->afterStateUpdated(function ($record, $state) {
                        // Runs after the state is saved to the database.
                    })
            
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
                Action::make('Verificar Email')
                    ->icon('heroicon-o-exclamation-triangle')
                    ->color('warning')
                    ->modalHeading('Verificar')
                    ->modalSubmitActionLabel('¿Desea verificar el usuario?')
                    ->successNotificationTitle('Usuario Verificado')
                    ->requiresConfirmation()
                    ->action(function (User $record){
                        $record->email_verified_at = date('Y-m-d H:m:s');
                        $record->save();
                    })
                    ->visible(fn (User $record): bool =>  is_null($record->email_verified_at)),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
