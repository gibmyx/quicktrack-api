<?php

declare(strict_types=1);

namespace Quicktrack\Brand\Infrastructure\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;

final class Brand extends Model
{
    protected $table = 'cars_brand';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'id',
        'value',
        'name',
        'status'
    ];
}
