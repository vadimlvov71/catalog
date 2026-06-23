<?php
namespace App\Http\Controllers\Admin\API;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Http\Requests\UpdateItemRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Models\CategoriesLocalization;
use App\Http\Requests\UpdateCategoryRequest;

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
        $items = Category::orderBy('id', 'desc')->get();
        foreach ($items as &$item) {
            if(!empty($item->image)){
                $item->image_url = Storage::url('uploads/' . $item->image);
            }else{
                $item->image_url = "";
            }
            if(!empty($item->preview)){
                $item->preview_url = Storage::url('uploads/' . $item->preview);
            }else{
                $item->preview_url = "";
            }
        }
        return response()->json([
            'status' => 'success',
            'message' => 'Привет из Laravel!',
            'items' => $items
        ]);
    }
    public function validateField(Request $request, $fieldName)
    {

        // Получите значение из тела запроса
        $value = $request->input($fieldName);

        if (!$value) {
            return response()->json([
                'message' => 'Поле не может быть пустым'
            ], 422);
        }

        // Проверьте уникальность в базе данных
        $exists = Category::where($fieldName, $value)->exists();

        if ($exists) {
            return response()->json([
                'message' => "Значение '{$value}' уже существует"
            ], 409); // 409 Conflict
        }

        // Если всё OK
        return response()->json([
            'message' => 'OK'
        ], 200);
    }
       /* $fieldname = $request->query('fieldname');
        $value = $request->query('value');
        $exists = Category::where($fieldname, $value)->exists();
        return response()->json(['unique' => !$exists, 'fieldname' => $request->all()]);
        */
        ///return response()->json(['field' => $field, 'value' => $value]);
    //}

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|unique:categories,name',
            'url' => 'required|unique:categories,url',
        ]);
        
        Category::create($data);
        return response()->json(['success' => true]);
    }
    public function edit(string $locale, int $id)
    {
        $category = Category::where('id', $id)
        ->first(); 
        
        $categoryLocalizes = CategoriesLocalization::where('category_id', $id)
            //->where('lang', $locale)
            ->get(); // or firstOrFail()
        
        $categories = Category::all();
        $select = [];
        foreach($categories as $categoryItem){
            $select[$categoryItem->id] = $categoryItem->name;
        }
         /////

        if(!empty($category->preview)){
            $category->preview_url = Storage::url('uploads/' . $category->preview);
        }else{
            $category->preview_url = "";
        }
        //$select = Category::lists('name', 'id');
        $select = Category::pluck('name', 'id');
        return response()->json([
            'status' => 'success',
            'message' => 'Привет из Laravel!',
            'items' => $category
        ]);
    }
    public function update(string $locale, int $id, UpdateCategoryRequest $request)
    {
        Log::info('Category updated test: ');
        $item = Category::find($id);
        if (!$item) {
            return response()->json(['status' => 'error', 'message' => 'Категория не найдена'], 404);
        } else {
           // return response()->json(['status' => 'test', 'message' => 'Категория  найдена'], 200);
        } 
        
        try {
            $item->update($request->validated());
             Log::info('Category updated successfully: ' . $item->name);

            return response()->json([
                'status' => 'success',
                'message' => 'Category updated successfully: ' . $item->name,
                'item' => $item->name
            ]);

        } catch (\Exception $e) {
             Log::info('Category updated error: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Ошибка при обновлении'], 422);
        }

    }
}