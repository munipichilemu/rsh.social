<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laragear\Rut\HasRut;

class Atencion extends Model
{
    use HasFactory, HasRut, HasUlids, SoftDeletes;

    protected $table = 'atenciones';

    protected $fillable = [
        'rut',
        'names',
        'lastname_1',
        'lastname_2',
        'sector_id',
        'phone',
        'nationality',
        'tramite_id',
    ];

    protected $casts = [
    ];

    protected $appends = [
        'rut',
    ];

    public function tramite(): BelongsTo
    {
        return $this->belongsTo(Tramite::class, 'tramite_id');
    }

    public function sector(): BelongsTo
    {
        return $this->belongsTo(Sector::class, 'sector_id');
    }
}
