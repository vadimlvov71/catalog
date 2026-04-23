<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Category;
use App\Models\Language;
use Illuminate\Http\Request;


use Session;

class AdminLocaleController extends Controller
{
    //INSERT INTO categories (name) 
//Values ('one')
    public function index()
    {
        $items = Language::orderBy('id', 'desc')->get();
        return view('admin.languages.index', compact('items'));
    }

    public function set($locale)
    {
    return redirect()->route('admin.index', $locale);
     //echo "test aaa";
     //exit;
    }

    public function store(Request $request)
    {
        // Validate the incoming file. Refuses anything bigger than 2048 kilobyes (=2MB)
       /* $request->validate([
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
*/
        $request->validate([
            'name' => 'required',
            'description' => 'required',
           // 'category_id' => 'category_id',
        ]);

        Language::create($request->all());
        //exit;

        return redirect()->route('admin.language.index')
                        ->with('success', 'Item Language created successfully.');
    }

    public function show(Item $Item)
    {
        return view('admin.show', compact('Item'));
    }

    public function edit(int $id)
    {
        $categories = Category::all();
        $select = [];
        foreach($categories as $category){
            $select[$category->id] = $category->name;
        }
        //$select = Category::lists('name', 'id');
        $select = Category::pluck('name', 'id');
        $item = Item::find($id);
        return view('admin.items.edit', compact('item', 'categories', 'select'));
    }

    public function update(Request $request)
    {
        $id = $request->input('id');
        $name = $request->input('name');
        ////////////////
        // Store the file in storage\app\public folder
        $request->validate([
            'file_upload' => 'required|mimes:jpg,png,jpeg|max:2048',
            'name' => 'required',
            'description' => 'required',
        ]);
        $imageNameHashed = "test";
        if ($request->hasFile('file_upload')) {
            $max_size = (int) ini_get('upload_max_filesize') * 1000;
            $file = $request->file('file_upload');
            $fileName = $file->getClientOriginalName();
            $filePath = $file->store('uploads', 'public');
            $imageNameHashed = $file->hashName(); // Generate a unique, random name...
            //$extension = $file->extension(); // Determine the file's extension based on the file's MIME type...
        }else{
            echo "no file <br>";
        }
        echo "<pre>";
        print_r($imageNameHashed);
        echo "</pre>";
        ///exit;
        /////////////////////////
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
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