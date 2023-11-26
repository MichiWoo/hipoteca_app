<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Compraventa()
 * @method static static Refinanciacion()
 * @method static static CapitalPrivado()
 * @method static static PrestamoPersonal()
 */
final class ViviendaType extends Enum
{
    const Compraventa = 1;
    const Refinanciacion = 2;
    const CapitalPrivado = 3;
    const PrestamoPersonal = 3;
}
