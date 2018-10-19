<?php

namespace Agoujil\LaravelAuthLog\Listeners;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Auth\Events\Login;
use Agoujil\LaravelAuthLog\AuthLog;

class LoginListener{

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
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    { 
        $_authLog = new \Agoujil\LaravelAuthLog\AuthLog();
        $_authLog->ip_address=$this->request->ip();
        $_authLog->user_agent=$this->request->userAgent();
        $_authLog->login_at=Carbon::now();
        $_authLog->user_id=$event->user->id;
        $_authLog->save();
        
    }
}