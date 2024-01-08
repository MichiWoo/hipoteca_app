<?php declare(strict_types=1);

namespace App\Enums;
 
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;
use Filament\Support\Contracts\HasColor;
 
enum BankStatus: int implements HasLabel, HasColor, HasIcon
{
    case PENDIENTE = 1;
    case APROBADA = 2;
    case DENEGADA = 3;
 
    public function getLabel(): ?string
    {
        return match ($this) {
            self::PENDIENTE => 'Pendiente',
            self::APROBADA => 'Aprobada',
            self::DENEGADA => 'Denegada',
        };
    }
 
    public function getColor(): string|array|null
    {
        return match ($this) {
            self::PENDIENTE => 'success',
            self::APROBADA => 'warning',
            self::DENEGADA => 'gray',
        };
    }
 
    public function getIcon(): ?string
    {
        return match ($this) {
            self::PENDIENTE => 'heroicon-m-pencil',
            self::APROBADA => 'heroicon-m-eye',
            self::DENEGADA => 'heroicon-m-check',
        };
    }
}