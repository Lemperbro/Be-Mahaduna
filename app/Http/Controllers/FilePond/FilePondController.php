<?php

namespace App\Http\Controllers\FilePond;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Repositories\SaveFile\SaveFileRepository;
use App\Http\Requests\FilePond\FilePondCreateRequest;


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
