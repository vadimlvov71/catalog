<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $lang = $request->segment(1);
        echo ":::::2".$lang."<br>";
        if(strlen($lang) === 2 && in_array($lang, config('languages'))){
            echo "aaaaa";
            exit;
        }else{
            echo "nooooooooo";
            exit;
        }
    
        return $next($request);
    }
}
