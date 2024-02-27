<?php
namespace App\Repositories;

use Illuminate\Support\Facades\File;


class SaveImageRepository
{

    public function saveImageSingle($imageData, $lokasiSave)
    {
        $lokasi = trim($lokasiSave, '/');
        $extension = $imageData->getClientOriginalExtension();
        $name = uniqid() . '-' . now()->timestamp . '.' . $extension;
        $imageData->move($lokasi, $name);
        $response = url('/') . '/' . $lokasi . '/' . $name;
        return $response;

    }


    public function updateImageSingle($imageData, $lokasiSave, $oldImage)
    {
        $lokasi = trim($lokasiSave, '/');
        $extension = $imageData->getClientOriginalExtension();
        $name = uniqid() . '-' . now()->timestamp . '.' . $extension;
        $up = $imageData->move($lokasi, $name);

        if ($up) {
            $storage = public_path($lokasi . '/' . basename($oldImage));
            if (File::exists($storage)) {
                unlink($storage);
            }
        }
        $response = url('/') . '/' . $lokasi . '/' . $name;
        return $response;

    }

    public function deleteImageSingle($lokasi, $image){
        $imageName = basename($image);
        $storage = public_path($lokasi.'/'.$imageName);
        if(File::exists($storage)){
            unlink($storage);
        }
        return true;
    }
}