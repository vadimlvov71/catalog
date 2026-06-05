<?php
// app/Http/Controllers/Admin/API/ImageController.php
namespace App\Http\Controllers\Admin\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Str;
use Exception;


class ImageController extends Controller
{
    public function store( Request $request)
    {
        try {
            // ✅ Validate file
            $validated = $request->validate([
                'file' => 'required|file|mimes:jpg, jpeg,png,pdf,doc,docx|max:5120', // 5MB
                //'title' => 'nullable|string|max:255',
            ]);

            // ✅ Check if file exists in request
            if (!$request->hasFile('file')) {
                Log::error('File upload error: ', [
                'exception' => 'file doesnt exist in request',
                ]);
                return response()->json([
                    'status' => 'error',
                    'message' => 'file doesnt exist in request!',

                ]);
            }
            $id = $request->input('id');
            $type = $request->input('type');
            $file = $request->file('file');
            $preview = $request->file('preview');
               
             Log::info('test info', [
                'id' => $id,
                'type' => $type,
                'file' => $file,
                'preview' => $preview,
            ]);
            // ✅ Validate file is uploaded correctly
            if (!$file->isValid()) {
                return redirect()->back()
                    ->with('error', 'File upload failed. Please try again.');
            }

            // ✅ Generate unique filename
            $generated = time() . '_' . Str::random(10) ;
            $fileName = $generated . '.' . $file->getClientOriginalExtension();
            $previewName = 'preview_image_' . $generated . '.jpeg';
            // ✅ Store file
            $path = $file->storeAs('uploads', $fileName, 'public');
            $previewPath = $preview->storeAs('uploads', $previewName, 'public');
            // ✅ Log success
            Log::info('File uploaded successfully', [
                'original_name' => $file->getClientOriginalName(),
                'stored_name' => $fileName,
                'path' => $path,
                'previewPath' => $previewPath,
                'size' => $file->getSize(),
            ]);
            if ($type) {
                if ($type == "category") {
                    if($item = Category::find($id)){
                        $item->update(["image" => $fileName, "preview" => $previewName]);
                    }else{
                        throw new Exception('Category is absent');
                    }
                        
                }
            } else {
                throw new Exception('type is absent');
                Log::error('File upload error: ', [
                'exception' => 'type is absent',
            ]);
            }
            return redirect()->back()
                ->with('success', 'File uploaded successfully!')
                ->with('file_path', $path);

        } catch (Exception $e) {
            // ✅ Log error
            Log::error('File upload error: ' . $e->getMessage(), [
                'exception' => $e,
            ]);
            return response()->json([
                    'status' => 'error',
                    'message' => 'Failed to upload file. Please try again.',

                ]);
            
        }
    }

    /**
     * Download file
     */
    public function download($filename)
    {
        try {
            $filePath = 'uploads/' . $filename;

            if (!Storage::disk('public')->exists($filePath)) {
                return redirect()->back()
                    ->with('error', 'File not found.');
            }

            return Storage::disk('public')->download($filePath);

        } catch (Exception $e) {
            Log::error('File download error: ' . $e->getMessage());

            return redirect()->back()
                ->with('error', 'Failed to download file.');
        }
    }

    /**
     * Delete file
     */
    public function delete($filename)
    {
        try {
            $filePath = 'uploads/' . $filename;

            if (!Storage::disk('public')->exists($filePath)) {
                return redirect()->back()
                    ->with('error', 'File not found.');
            }

            Storage::disk('public')->delete($filePath);

            Log::info('File deleted', ['filename' => $filename]);

            return redirect()->back()
                ->with('success', 'File deleted successfully.');

        } catch (Exception $e) {
            Log::error('File delete error: ' . $e->getMessage());

            return redirect()->back()
                ->with('error', 'Failed to delete file.');
        }
    }
}