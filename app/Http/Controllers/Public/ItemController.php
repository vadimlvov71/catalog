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
class ItemController extends Controller
{
    protected $itemRepository;
    public function __construct(
        ItemRepository $itemRepository
        )
    {
        $this->itemRepository = $itemRepository;
    }

    public function index($locale, $category, $id)
    {
        $pageTitle = 'Item';
        $sideBarData = [];
        $sideBarData['title']='First';
       /* if($locale == null){
            $locale = Config::get('app.locale');
        }*/
        echo "id::".$id."<br>";
        //$items = $this->itemRepository->getCategory();
        //$item = Item::find($id);
        $item = Item::with([
            'category:id,url',
            'category.localizations:id,category_id,name,lang',
        ])->findOrFail($id);
        $itemLocale = $item->getLocalNameOne($locale);
        //$description = $itemLocale->description;
        $description = "aaaa";
       // $pageTitle = $item['name'];
        /*echo "<pre>";
        print_r( $item);
        echo "</pre>";*/
        //exit;
        //$items = Item::get();
        $categories = Category::where('status', 'active')->get();
        //$categories = CategoriesLocalization::where('lang', 'ru')->get();
        /*return view('catalog.index', [
            'categories' => $categories,
            'items' => $items
        ]);*/
        
         ////////////
         $pageTitle = $itemLocale;
         $categoryName = $item->category->getLocalName($locale); 
         $sideBarData = [];
         $sideBarData['title'] = $pageTitle;
         //////////////
        echo "ITEM". $item->category_id."<br>";
        echo "categoryName". $categoryName."<br>";
         ///////////////
        $breadcrumbs = [
            ['title' => 'Home', 'url' => route('home', $locale)],
            ['title' => $categoryName, 'url' => route('category', ['locale' => $locale, 'category' => $item->category->url])],
            ['title' => $pageTitle, 'url' => '']
        ];
        ////////////
        return view('catalog.item', [
            'locale' => $locale,
            'breadcrumbs' => $breadcrumbs, 
            'pageTitle' => $pageTitle,
            'sideBarData' => $sideBarData,
            'categories' => $categories,
            'item' => compact('item'),
            'name' => $pageTitle,
            'description' => $description,
        ]);
        //return view('catalog.index');
    }
}