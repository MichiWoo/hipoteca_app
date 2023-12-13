<?php declare(strict_types=1);

namespace App\Enums;
 
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;
use Filament\Support\Contracts\HasColor;
 
enum UserCategory: int implements HasLabel, HasColor, HasIcon
{
    case ADMINISTRATOR = 1;
    case SUPERVISOR = 2;
    case USER = 3;
 
    public function getLabel(): ?string
    {
        return match ($this) {
            self::ADMINISTRATOR => 'Administrador',
            self::SUPERVISOR => 'Supervisor',
            self::USER => 'Usuario',
        };
    }
 
    public function getColor(): string|array|null
    {
        return match ($this) {
            self::ADMINISTRATOR => 'success',
            self::SUPERVISOR => 'warning',
            self::USER => 'gray',
        };
    }
 
    public function getIcon(): ?string
    {
        return match ($this) {
            self::ADMINISTRATOR => 'heroicon-m-pencil',
            self::SUPERVISOR => 'heroicon-m-eye',
            self::USER => 'heroicon-m-check',
        };
    }
}