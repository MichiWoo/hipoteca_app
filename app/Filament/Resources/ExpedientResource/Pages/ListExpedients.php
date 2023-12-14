<?php

namespace App\Filament\Resources\ExpedientResource\Pages;

use App\Filament\Resources\ExpedientResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListExpedients extends ListRecords
{
    protected static string $resource = ExpedientResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
