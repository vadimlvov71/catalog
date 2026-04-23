<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Http\Requests\UpdateItemRequest;
use Illuminate\Support\Facades\Log;

use Session;

class AdminItemsController extends Controller
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

    public function create()
    {
        $categories = Category::all();
        $select = [];
        foreach($categories as $category){
            $select[$category->id] = $category->name;
            //$select[] = ["id" => $category->id, "name" => $category->name];
        }
        $select = Category::pluck('name', 'id');
        return view('admin.items.create', compact(['categories','select']));
    }

    public function store(Request $request)
    {
        // Validate the incoming file. Refuses anything bigger than 2048 kilobyes (=2MB)
        $request->validate([
            'file_upload' => 'required|mimes:jpg,png|max:2048',
        ]);
        //$path = $request->file('avatar')->store('avatars');
        // Store the file in storage\app\public folder
        $file = $request->file('file_upload');
        $fileName = $file->getClientOriginalName();
        $filePath = $file->store('uploads', 'public');

        // Store file information in the database
        $uploadedFile = new UploadedFile();
        $uploadedFile->filename = $fileName;
        $uploadedFile->original_name = $file->getClientOriginalName();
        $uploadedFile->file_path = $filePath;
        $uploadedFile->save();

        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'category_id' => 'category_id',
        ]);

        Item::create($request->all());
        exit;

        return redirect()->route('admin.item.index')
                        ->with('success', 'Item created successfully.');
    }

    public function show(Item $Item)
    {
        return view('admin.show', compact('Item'));
    }

    public function edit(string $locale, int $id)
    {
        $categories = Category::all();
        /////
        $pageTitle = "Items";
        $sideBarData = [];
        $sideBarData['title'] = $pageTitle;
        $breadcrumbs = [
            ['title' => 'Home', 'url' => route('admin.index', $locale)],
            ['title' => $pageTitle, 'url' => '']
        ];
        //////
        $select = [];
        foreach($categories as $category){
            $select[$category->id] = $category->name;
        }
        //$select = Category::lists('name', 'id');
        $select = Category::pluck('name', 'id');
        $item = Item::find($id);
        return view('admin.items.edit', compact('item', 'sideBarData', 'categories', 'select', 'locale', 'breadcrumbs'));
    }

    public function update(string $locale, int $id, UpdateItemRequest $request)
    {
        try {
            // Get validated data
            $validated = $request->validated();
            /*
        echo "<pre>";
        print_r($request->validated());
        echo "</pre>";
        echo "locale:::".$locale."<br>";
        echo "id:::". $id;
        exit;
        */
            // Find item or throw error
            $item = Item::findOrFail($id);

            // Handle file upload
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('items', 'public');
                $validated['image'] = $imagePath;
            }

            // Update item
            $item->update($validated);

            Log::info('Item updated successfully: ' . $item->id);

            return redirect()->route('admin.item.edit', ['locale' => $locale, 'id' => $item->id])
                           ->with('success', 'Item updated successfully!');

            } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
                Log::warning('Item not found: ' . $id);
                return redirect()->route('admin.item.index', ['locale' => $locale])
                            ->with('error', 'Item not found.');

            } catch (\Exception $e) {
                Log::error('Error updating item: ' . $e->getMessage());
                return redirect()->back()
                            ->with('error', 'Failed to update item. Please try again.');
            }
        

        ////////////////
        // Store the file in storage\app\public folder

       /* $imageNameHashed = "test";
        if ($request->hasFile('file_upload')) {
            $max_size = (int) ini_get('upload_max_filesize') * 1000;
            $file = $request->file('file_upload');
            $fileName = $file->getClientOriginalName();
            $filePath = $file->store('uploads', 'public');
            $imageNameHashed = $file->hashName(); // Generate a unique, random name...
            //$extension = $file->extension(); // Determine the file's extension based on the file's MIME type...
        }else{
            echo "no file <br>";
        }*/

    /*    echo ":::".$name;
     echo ":::". $id;
     exit;*/
            $item = Item::find($id);
            $item->update([
                'name' => $request->name,
                'description' => $request->description,
                'category_id' => $request->category_id,
                'item_image' => $imageNameHashed,
            ]);

            // redirect
            Session::flash('message', 'Successfully updated shark!');

        return redirect()->route('admin.item.index')
                        ->with('success', 'Item updated successfully.');
    }

    public function destroy(Item $Item)
    {
        $Item->delete();

        return redirect()->route('admin.index')
                        ->with('success', 'Item deleted successfully.');
    }
}