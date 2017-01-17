<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class Login extends Model
{
    public function save(array $options = array())
    {
        $request = Request::instance();

        $this->attributes['ip'] = $request->ip();
        $this->attributes['user_agent'] = $request->server('HTTP_USER_AGENT');

        parent::save($options);
    }

    /**
     * @param $value
     */
    public function setUpdatedAtAttribute($value)
    {
        return;
    }
}
