<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Privateer\Uuid\EloquentUuid;

class Site extends Model
{
    use EloquentUuid;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
