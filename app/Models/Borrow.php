<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Borrow extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo',
        'inicial',
        'pendiente',
        'cuota',
        'bank_id'
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
