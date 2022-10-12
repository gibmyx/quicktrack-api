<?php

declare(strict_types=1);

namespace Quicktrack\EmailHistory\Infrastructure\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;

class EmailHistory extends Model
{
    protected $table = 'emails_history';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'id',
        'code',
        'name',
        'email',
        'phone',
        'type'
    ];
}
