<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Category;
use App\Models\ItemsLocalization;
use Illuminate\Http\Request;
use App\Repositories\ItemRepository;
use Illuminate\Support\Facades\Config;

class AdminController extends Controller
{
    protected $itemRepository;
    public function __construct(
        ItemRepository $itemRepository
    )
    {
        $this->itemRepository = $itemRepository;
    }
    
    public function index($locale)
    {
        echo "locale: ".$locale."<br>";
        $categories = Category::where('status', 'active')->get();
        if($locale == null){
            $locale = Config::get('app.locale');
        }
        $locales = Config::get('app.available_locales');
        $items = ItemsLocalization::all();
       // $items = Item::orderBy('id', 'desc')->get();
        $items = $this->itemRepository->getAll();
        $pageTitle = "Index";
        $sideBarData = [];
        $sideBarData['title'] = $pageTitle;
        return view('admin.index', compact(['items', 'sideBarData', 'categories', 'locale', 'locales']));
    }
    public function locale()
    {
       // if($locale == null){
            $locale = Config::get('app.locale');
       // }
        return redirect()->route('admin.index', $locale);
    }
    
}