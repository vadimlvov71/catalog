<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class CheckLocalization 
{
    protected $except = ['manager_secret'];
   // protected $except = ['admin.index/*'];

    public function handle(Request $request, Closure $next)
    {
        $lang = $request->segment(1);
        //echo "check:::::".$lang."<br>";
        //print_r(config('app.available_locales'));
       // exit;
        if(strlen($lang) === 0){
            echo "nooo lang<br>";
            return redirect()->route("set-forcely-locale");
            exit;
        }
        if(strlen($lang) !== 2){
            return redirect()->route("wrong-locale");
            echo "!== 2<br>";
            exit;
        }
        if(!in_array($lang, config('app.available_locales'))){
             return redirect()->route("wrong-locale");
             echo "no_lang_array<br>";
             exit;
         }
        /*else{
            echo "nooooooooo123";
            //return redirect()->route("wrong-locale");
            exit;
        }*/
        return $next($request);
    }
}