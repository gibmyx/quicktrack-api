<?php

declare(strict_types=1);

namespace Quicktrack\Car\Infrastructure\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $table = 'cars';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'id',
        'code',
        'brand',
        'color',
        'fuel',
        'gearbox',
        'kilometer',
        'model',
        'price',
        'status',
        'type',
        'year'
    ];

    
}
