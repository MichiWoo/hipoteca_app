<?php declare(strict_types=1);

namespace App\Enums;
 
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;
use Filament\Support\Contracts\HasColor;
 
enum ExpedientStatus: int implements HasLabel, HasColor, HasIcon
{
    case NO_CONTACTADO = 0;
    case CONTACTADO = 1;
    case ESPERANDO_DOC = 2;
    case TRAMITANDO = 3;
    case FIRMANDO = 4;
    case FALLIDA = 5;
 
    public function getLabel(): ?string
    {
        return match ($this) {
            self::NO_CONTACTADO => 'No contactado',
            self::CONTACTADO => 'Contactado',
            self::ESPERANDO_DOC => 'Esperando Documentación',
            self::TRAMITANDO => 'Tramitando',
            self::FIRMANDO => 'Firmando',
            self::FALLIDA => 'Fallida',
        };
    }
 
    public function getColor(): string|array|null
    {
        return match ($this) {
            self::NO_CONTACTADO => 'success',
            self::CONTACTADO => 'warning',
            self::ESPERANDO_DOC => 'gray',
            self::TRAMITANDO => 'blue',
            self::FIRMANDO => 'purple',
            self::FALLIDA => 'orange',
        };
    }
 
    public function getIcon(): ?string
    {
        return match ($this) {
            self::NO_CONTACTADO => 'heroicon-m-pencil',
            self::CONTACTADO => 'heroicon-m-eye',
            self::ESPERANDO_DOC => 'heroicon-m-check',
            self::TRAMITANDO => 'heroicon-m-check',
            self::FIRMANDO => 'heroicon-m-check',
            self::FALLIDA => 'heroicon-m-check',
        };
    }
}