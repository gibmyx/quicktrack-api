<?php

declare(strict_types=1);

namespace Quicktrack\EmailNotification\Infrastructure\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;

class EmailNotification extends Model
{
    protected $table = 'emails_notifications';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'id',
        'name',
        'email'
    ];
}
