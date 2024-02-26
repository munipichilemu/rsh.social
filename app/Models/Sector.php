<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static insert(array[] $array)
 * @method mapWithKeys(\Closure $param)
 */
class Sector extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'sectores';

    protected $fillable = [
        'name',
        'group',
    ];

    protected $casts = [

    ];
}
