<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\CategoriesLocalization;
use App\Models\Item;
use App\Repositories\ItemRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Config;
/**
* @author Vadim Podolyan <vadim.podolyan@gmail.com>

 * A websites catalog with a localization or without it
 */
class IndexController extends Controller
{
    protected $itemRepository;
    public function __construct(
        ItemRepository $itemRepository
    )
    {
        $this->itemRepository = $itemRepository;
    }

    public function index($locale=null)
    {
       // $locale = Session::get('locale');
        $items = $this->itemRepository->getAll();
        
        //$items = Item::get();
        $categories = Category::where('status', 'active')->get();

        
 
       // $categories->getLocalName($locale)->get();
       /* $categories = Category::where([
            ['lang', '=', $locale],
        ])
        //->whereNull('parent')
        ->with(['CategoriesLocalization'])
        ->get();
        */
        if($locale == null){
            $locale = Config::get('app.locale');
        }
        //$categories = CategoriesLocalization::where('lang', $locale)->get();
        /*return view('catalog.index', [
            'categories' => $categories,
            'items' => $items
        ]);*/
       /* echo "<pre>";
        print_r($categories);
        echo "</pre>";*/
        $pageTitle = "First123";
        $description = "test";
        $sideBarData = [];
        $sideBarData['title']='First';
        return view('catalog.index', [
            'title' => $pageTitle,
            'description' => $description,
            'locale' => $locale,
            'pageTitle' => $pageTitle,
            'sideBarData' => $sideBarData,
            'categories' => $categories,
            'items' => $items
        ]);
        //return view('catalog.index');
    }
   
}