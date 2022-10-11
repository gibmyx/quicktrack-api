<?php

declare(strict_types=1);

namespace Quicktrack\EmailHistory\Infrastructure\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;

class EmailHistory extends Model
{
    protected $table = 'emails_history';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'code',
        'name',
        'email',
        'phone',
        'type',
        'created_at',
        'updated_at',
    ];
}
