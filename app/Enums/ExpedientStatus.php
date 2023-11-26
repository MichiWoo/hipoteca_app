<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static NoContactado()
 * @method static static Contactado()
 * @method static static EsperandoDocumentacion()
 * @method static static Tramitando()
 * @method static static Firmando()
 * @method static static Fallida()
 */
final class ExpedientStatus extends Enum
{
    const NoContactado = 0;
    const Contactado = 1;
    const EsperandoDocumentacion = 2;
    const Tramitando = 3;
    const Firmando = 4;
    const Fallida = 5;
}
