<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Procedure extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha_presentacion',
        'fecha_resolucion',
        'estado',
        'banco_id',
    ];

    public function banco(): BelongsTo
    {
        return $this->belongsTo(Bank::class);
    }

    public function expediente(): BelongsTo
    {
        return $this->belongsTo(Expedient::class);
    }
}
