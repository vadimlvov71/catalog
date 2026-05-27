<?php
namespace App\Http\Controllers\Admin\API;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Http\Requests\UpdateItemRequest;
use Illuminate\Support\Facades\Log;

use Session;

class AdminJSONCategoriesController extends Controller
{
    //INSERT INTO categories (name) 
//Values ('one')
    public function index($locale)
    {
        $items = Item::orderBy('id', 'desc')->get();
        $pageTitle = "Items";
        $sideBarData = [];
        $sideBarData['title'] = $pageTitle;
        $breadcrumbs = [
            ['title' => 'Home', 'url' => route('admin.index', $locale)],
            ['title' => $pageTitle, 'url' => '']
        ];

        return view('admin.items.index', compact('items', 'sideBarData', 'locale', 'breadcrumbs'));
    }

    public function getItems($locale)
    {
        $items = Item::orderBy('id', 'desc')->get();
        return response()->json([
            'status' => 'success',
            'message' => 'Привет из Laravel!',
            'items' => $items
        ]);
    }
}