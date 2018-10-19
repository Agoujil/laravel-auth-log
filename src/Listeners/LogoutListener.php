<?php

namespace Agoujil\LaravelAuthLog\Listeners;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Agoujil\LaravelAuthLog\AuthLog;
use Illuminate\Auth\Events\Logout;


class LogoutListener{

     /**
     * The request.
     *
     * @var \Illuminate\Http\Request
     */
    public $request;
    
    /**
     * Create the event listener.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    /**
     * Handle the event.
     *
     * @param  Logout  $event
     * @return void
     */
    
     public function handle(Logout $event)
    {
        $user=$event->user;
        $ip = $this->request->ip();
        $userAgent = $this->request->userAgent();
        $_authLog = AuthLog::whereIpAddress($ip)->whereUserId($user->id)->whereUserAgent($userAgent)->first();
        if (! $_authLog) {
            $_authLog = new \AuthLog([
                'ip_address' => $ip,
                'user_agent' => $userAgent,
            ]);
        }
        $_authLog->user_id=$event->user->id;
        $_authLog->logout_at = Carbon::now();
        $_authLog->save();
    }

}
