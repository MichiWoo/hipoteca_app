<?php

namespace App\Filament\Resources\ConexionResource\Pages;

use App\Filament\Resources\ConexionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListConexions extends ListRecords
{
    protected static string $resource = ConexionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
