<?php declare(strict_types=1);

namespace App\Enums;
 
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;
use Filament\Support\Contracts\HasColor;
 
enum UserDepartament: int implements HasLabel, HasColor, HasIcon
{
    case SISTEMA = 1;
    case EXTERNO = 2;
 
    public function getLabel(): ?string
    {
        return match ($this) {
            self::SISTEMA => 'Sistema',
            self::EXTERNO => 'Externo',
        };
    }
 
    public function getColor(): string|array|null
    {
        return match ($this) {
            self::SISTEMA => 'success',
            self::EXTERNO => 'warning',
        };
    }
 
    public function getIcon(): ?string
    {
        return match ($this) {
            self::SISTEMA => 'heroicon-m-pencil',
            self::EXTERNO => 'heroicon-m-eye',
        };
    }
}