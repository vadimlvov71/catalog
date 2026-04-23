<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexNewController extends Controller
{
    public function index($locale=null)
    {
       // $locale = Session::get('locale');
        echo "test";
    }
        
}
