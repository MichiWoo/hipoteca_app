<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Formulario extends Model
{
    use HasFactory;

    protected $table = 'forms';

    protected $fillable = [
        'nombre',
        'email',
        'mensaje',
        'telefono',
        'localidad',
        'ip',
        'fecha',
        'movil',
        'user_id'
    ];

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
   
}
