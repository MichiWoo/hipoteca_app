<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
  * @method static Funcionario()
  * @method static Temporal()
  * @method static Autonomo()
  * @method static EmpleadaHogar()
 */
final class ContratoType extends Enum
{
    const Indefinido = 1;
    const Funcionario = 2;
    const Temporal = 3;
    const Autonomo = 4;
    const EmpleadaHogar = 5;
}
