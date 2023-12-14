<?php

namespace App\Models;

use App\Enums\ContratoType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Holder extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'edad',
        'dni',
        'empleo',
        'tipo_contrato',
        'antiguedad',
        'salario',
        'pagos',
        'renta',
        'expedient_id'
    ];

    protected $casts = [
        'tipo_contrato' => ContratoType::class,
    ];

    public function expedient(): BelongsTo
    {
        return $this->belongsTo(Expedient::class);
    }
}
