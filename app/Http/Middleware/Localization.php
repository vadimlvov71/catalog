<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class Localization
{
    public function handle(Request $request, Closure $next)
    {
        $lang = $request->segment(1);
        echo ":::::".$lang."<br>";
        if(strlen($lang) === 2 && in_array($lang, config('languages'))){
            echo "yes";
            exit;
        }else{
            echo "nooooooooo";
            exit;
        }
        /*echo "!!!<pre>";
    print_r($locale);
    echo "</pre>";*/
    /*if (isset($locale) && in_array($locale, Config::get('app.available_locales'))) {
        echo "yes";
        exit;
    }else{
        echo "locale".$locale;
        echo "no";
        exit;
    }*/
       /* if (Session::has('locale')) {
            App::setLocale(Session::get('locale'));
            //echo "get locale: ".Session::get('locale')."<br>";
            //exit;
        }*/
        
        return $next($request);
    }
}