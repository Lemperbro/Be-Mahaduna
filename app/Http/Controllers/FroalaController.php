<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class FroalaController extends Controller
{
    //

    public function uploadImageFroala(Request $request)
    {

        try {
            if ($request->hasFile('file') && $request->file('file')->isValid()) {
                $image = $request->file('file');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $location = 'uploads/imagesFroala/';

                if (!file_exists($location)) {
                    mkdir($location, 0755, true);
                }

                $image->move($location, $filename);
                return response()->json([
                    'link' => asset($location . $filename),
                ]);
            } else {
                return response()->json([
                    'error' => 'Invalid or missing image file.',
                ]);
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'error' => 'Error uploading image.',
            ], 500);
        }
    }

    public function deleteImage(Request $request)
    {
        try {
            if ($request->has('image_url')) {
                $imageUrl = $request->input('image_url');
                $explode = explode('/', $imageUrl);
                $index = count($explode) - 1;
                $fileName = $explode[$index];
                $imagePath = public_path('/uploads/imagesFroala/' . $fileName);
                if (file_exists($imagePath)) {
                    unlink($imagePath);

                    return response()->json([
                        'success' => true,
                        'message' => 'Image deleted successfully.'
                    ]);
                }
            }
            return response()->json([
                'success' => false,
                'message' => 'Image not found or unable to delete.',
                'path' => $imagePath
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error deleting image.'
            ], 500);
        }
    }




}


