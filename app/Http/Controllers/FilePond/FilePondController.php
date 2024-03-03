<?php

namespace App\Http\Controllers\FilePond;

use App\Http\Controllers\Controller;
use App\Http\Requests\FilePond\FilePondCreateRequest;
use App\Repositories\SaveFileRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class FilePondController extends Controller
{
    //
    private $saveFile;

    public function __construct()
    {
        $this->saveFile = new SaveFileRepository;
    }

    public function postImage(FilePondCreateRequest $request, $folder)
    {
        $folder = trim($folder, '/');
        $image = $this->saveFile->saveFileSingle($request->imageName, 'uploads/' . $folder);
        return $image;
    }

    public function deleteImage(Request $request, $folder)
    {
        $fileName = basename($request->input('imageName'));
        $filePath = public_path("uploads/$folder/$fileName");

        if (File::exists($filePath)) {
            File::delete($filePath);
            return response()->json(['message' => 'File deleted successfully']);
        }
        return response()->json(['error' => 'File not found'], 400);
    }
}
