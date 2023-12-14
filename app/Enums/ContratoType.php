<?php declare(strict_types=1);

namespace App\Enums;
 
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;
use Filament\Support\Contracts\HasColor;
 
enum ContratoType: int implements HasLabel, HasColor, HasIcon
{
    case INDEFINIDO = 1;
    case FUNCIONARIO = 2;
    case TEMPORAL = 3;
    case AUTONOMO = 4;
    case EMPLEADA_HOGAR = 5;
 
    public function getLabel(): ?string
    {
        return match ($this) {
            self::INDEFINIDO => 'Indefinido',
            self::FUNCIONARIO => 'Funcionario',
            self::TEMPORAL => 'Temporal',
            self::AUTONOMO => 'Autónomo',
            self::EMPLEADA_HOGAR => 'Empleada Hogar',
        };
    }
 
    public function getColor(): string|array|null
    {
        return match ($this) {
            self::INDEFINIDO => 'success',
            self::FUNCIONARIO => 'warning',
            self::TEMPORAL => 'gray',
            self::AUTONOMO => 'blue',
            self::EMPLEADA_HOGAR => 'purple',
        };
    }
 
    public function getIcon(): ?string
    {
        return match ($this) {
            self::INDEFINIDO => 'heroicon-m-pencil',
            self::FUNCIONARIO => 'heroicon-m-eye',
            self::TEMPORAL => 'heroicon-m-check',
            self::AUTONOMO => 'heroicon-m-check',
            self::EMPLEADA_HOGAR => 'heroicon-m-eye',
        };
    }
}