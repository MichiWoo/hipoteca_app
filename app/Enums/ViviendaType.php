<?php declare(strict_types=1);

namespace App\Enums;
 
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;
use Filament\Support\Contracts\HasColor;
 
enum ViviendaType: int implements HasLabel, HasColor, HasIcon
{
    case COMPRAVENTA = 1;
    case REFINANCIACION = 2;
    case CAPITAL_PRIVADO = 3;
    case PRESTAMO_PERSONAL = 4;
 
    public function getLabel(): ?string
    {
        return match ($this) {
            self::COMPRAVENTA => 'Compraventa',
            self::REFINANCIACION => 'Refinanciación',
            self::CAPITAL_PRIVADO => 'Capital Privado',
            self::PRESTAMO_PERSONAL => 'Préstamo Personal',
        };
    }
 
    public function getColor(): string|array|null
    {
        return match ($this) {
            self::COMPRAVENTA => 'success',
            self::REFINANCIACION => 'warning',
            self::CAPITAL_PRIVADO => 'gray',
            self::PRESTAMO_PERSONAL => 'blue',
        };
    }
 
    public function getIcon(): ?string
    {
        return match ($this) {
            self::COMPRAVENTA => 'heroicon-m-pencil',
            self::REFINANCIACION => 'heroicon-m-eye',
            self::CAPITAL_PRIVADO => 'heroicon-m-check',
            self::PRESTAMO_PERSONAL => 'heroicon-m-check',
        };
    }
}