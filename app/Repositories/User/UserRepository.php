<?php
namespace App\Repositories\User;

use App\Http\Resources\User\UserResource;
use Exception;

class UserRepository implements UserInterface{



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

}