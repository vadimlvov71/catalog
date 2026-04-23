<?php

namespace App\Http\Controllers\Local;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Config;
/**
* @author Vadim Podolyan <vadim.podolyan@gmail.com>

 */
class ChangeLanguageController extends Controller
{
    
    public function index($locale)
    {
       // Session::put('locale', $locale);
        ///url('/') - http://localhost:83
        $segments = str_replace(url('/'), '', url()->previous());
        
       /* echo "!!!<pre>";
        print_r($segments);
        echo "</pre>";*/
        $segments = array_filter(explode('/', $segments));
       /* echo "111111_______<pre>";
        print_r( $segments);
        echo "</pre>";*/
        if($segments[1] !== "errors"){
            $replacements = [];
            $replacements[1] = $locale;
        
            $newArray = array_replace($segments, $replacements);       
            //array_unshift($segments, $locale);
          /*  echo "222222_______<pre>";
            print_r($newArray);
            echo "</pre>";*/
           
            $backRoute = implode('/', $newArray);
        }else{
            $backRoute = $locale;
        }
        
       // echo "backRoute: ".$backRoute."<br>";
        //exit;
        return redirect()->to($backRoute);
    }
    public function forcely()
    {
       // Session::put('locale', $locale);
        ///url('/') - http://localhost:83
        $segments = str_replace(url('/'), '', url()->previous());
        $lang = Config::get('app.locale');
        print_r(Config::get('app.locale')); 
        echo "chl_ang<br>";
        //exit;
       
        echo "backRoute: ".$lang."<br>";
        return redirect()->to($lang);
    }
}