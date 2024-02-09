<?php
namespace App\Repositories;

use App\Http\Resources\User\UserResource;
use App\Repositories\Interfaces\UserInterface;
use Exception;

class UserRepositories implements UserInterface{



    public function GetUserLogin()
    {

        try{
            $data = Auth()->user();
            return UserResource::make($data);
            
        }catch(Exception $e){
            return response()->json([
                'error' => [
                    'message' => $e->getMessage()
                ]
            ]);
        }

        
    }

    public function coba($data){

    }
}