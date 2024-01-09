<?php

namespace App\Models;

use App\Enums\ExpedientStatus;
use App\Enums\ViviendaType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Expedient extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero',
        'fecha',
        'tipo',
        'vivienda',
        'estado',
        'fecha_llamada',
        'telefono1',
        'telefono2',
        'email',
        'importe_compra',
        'aportacion',
        'valor_aproximado',
        'importe_prestamo',
        'provincia',
        'localidad',
        'direccion',
        'user_id',
    ];

    protected $casts = [
        'tipo' => ViviendaType::class,
        'estado' => ExpedientStatus::class
    ];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function holders(): HasMany
    {
        return $this->hasMany(Holder::class);
    }

    public function borrow(): HasOne
    {
        return $this->HasOne(Borrow::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function observations(): HasMany
    {
        return $this->hasMany(Observation::class);
    }

    public function procedures(): HasMany
    {
        return $this->hasMany(Procedure::class);
    }
    
}
