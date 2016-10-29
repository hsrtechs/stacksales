<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class LocalizationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->hasSession('local'))
        {
            App::setLocale($request->session()->get('local'));
        }else{
            $ip = $request->ip();
            try{
                $details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
            }catch (\Exception $e)
            {
                $details = new \stdClass;
                $details->country = 'en';
            }
            if($details->country == 'cn')
            {
                $request->session()->put('local', 'cn');
                App::setLocale('cn');
            }
        }

        return $next($request);
    }
}
