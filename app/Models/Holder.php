<?php

namespace App\Models;

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

    public function expediente(): BelongsTo
    {
        return $this->belongsTo(Expediente::class);
    }
}
