<?php

declare(strict_types=1);

namespace Quicktrack\Infrastructure\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;

final class Car extends Model
{
    protected $table = 'cars';
    protected $fillable = [
        'id',
        'code',
        'color',
        'fuel',
        'gearbox',
        'kilometer',
        'model',
        'price',
        'status',
        'type',
        'year',
        'createdAt',
        'updatedAt'
    ];
}