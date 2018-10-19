<?php
namespace Agodev\LaravelAuthLog;

use Illuminate\Database\Eloquent\Model;

class AuthLog extends Model
{
    

    protected $guarded = ['id'];

    public $timestamps = false;

    protected $table = 'user_auth_log';

    public function getUserModelName()
    {
        //for laravel 5.0 - 5.1
        if (! is_null(config('auth.model'))) {
            return config('auth.model');
        }
        //for laravel >= 5.2
        if (! is_null(config('auth.providers.users.model'))) {
            return config('auth.providers.users.model');
        }
        return null;
    }

}