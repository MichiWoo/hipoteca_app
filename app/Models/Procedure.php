<?php

namespace App\Models;

use App\Enums\BankStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Procedure extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha_presentacion',
        'fecha_resolucion',
        'estado',
        'bank_id',
    ];

    protected $casts = [
        'estado' => BankStatus::class
    ];
    public function bank(): BelongsTo
    {
        return $this->belongsTo(Bank::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
