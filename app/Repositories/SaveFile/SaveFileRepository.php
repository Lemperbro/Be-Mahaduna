<?php
namespace App\Repositories\SaveFile;

use Illuminate\Support\Facades\File;


class SaveFileRepository
{

    public function saveFileSingle($fileData, $lokasiSave)
    {
        $lokasi = trim($lokasiSave, '/');
        $extension = $fileData->getClientOriginalExtension();
        $name = uniqid() . '-' . now()->timestamp . '.' . $extension;
        $fileData->move($lokasi, $name);
        // $response = url('/') . '/' . $lokasi . '/' . $name;
        $response = $lokasi . '/' . $name;
        return $response;
    }


    public function updateFileSingle($fileData, $lokasiSave, $oldFile)
    {
        $lokasi = trim($lokasiSave, '/');
        $extension = $fileData->getClientOriginalExtension();
        $name = uniqid() . '-' . now()->timestamp . '.' . $extension;
        $up = $fileData->move($lokasi, $name);

        if ($up) {
            $storage = public_path($lokasi . '/' . basename($oldFile));
            if (File::exists($storage)) {
                unlink($storage);
            }
        }
        // $response = url('/') . '/' . $lokasi . '/' . $name;

        $response = $lokasi . '/' . $name;
        return $response;

    }

    public function deleteFileSingle($lokasi, $file)
    {
        $fileName = basename($file);
        $storage = public_path($lokasi . '/' . $fileName);
        if (File::exists($storage)) {
            unlink($storage);
        }
        return true;
    }
}