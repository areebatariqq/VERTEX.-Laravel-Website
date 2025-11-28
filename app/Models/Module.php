<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Module extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'fee',
        'earlybird_fee',
        'team_min',
        'team_max',
        'description',
        'image',
        'duration',
        'date',
        'slug',
    ];

    protected $casts = [
        'fee' => 'decimal:2',
        'earlybird_fee' => 'decimal:2',
        'prize' => 'decimal:2',
        'date' => 'date',
    ];
}
