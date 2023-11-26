<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Bank extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
    ];


    public function expedientes(): BelongsToMany
    {
        return $this->belongsToMany(Expedient::class);
    }

    public function tramites(): BelongsToMany
    {
        return $this->belongsToMany(Procedure::class);
    }
}
