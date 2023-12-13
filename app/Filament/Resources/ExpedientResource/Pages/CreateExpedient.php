<?php

namespace App\Filament\Resources\ExpedientResource\Pages;

use App\Filament\Resources\ExpedientResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateExpedient extends CreateRecord
{
    protected static string $resource = ExpedientResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->user()->id;
        return $data;
    }
}
