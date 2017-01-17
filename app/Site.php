<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Privateer\Uuid\EloquentUuid;
use Spatie\Activitylog\Traits\LogsActivity;

class Site extends Model
{
    use EloquentUuid, LogsActivity;

    protected $guarded = [];

    protected static $logAttributes = ['subdomain', 'type', 'ttl', 'target'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function expires_at($format = null)
    {
        if($this->getAttribute('lifespan') === 0) return 'Never';

        $expires_at = $this->getAttribute('created_at')->addDays($this->getAttribute('lifespan'));

        if($format) return $expires_at->format($format);

        return $expires_at;
    }
}
