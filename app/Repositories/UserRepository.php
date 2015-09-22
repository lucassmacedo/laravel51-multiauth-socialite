<?php
/**
 * Created by PhpStorm.
 * User: tabutcu
 * Date: 2/28/15
 * Time: 3:03 PM
 */

namespace App\Repositories;
use App\User;
use Image;
use Storage;
use File;

class UserRepository {

    public function findByUsernameOrCreate($userData) {
      
        $user = User::where('email', $userData->email)->first();
      
    	if(count($user) > 0){
    		return $user;
    	}
 
        $user =  User::Create([
            'firstname'  =>  !empty($userData->user['first_name']) ? $userData->user['first_name'] : $userData->nickname,
            'lastname'  =>  !empty($userData->user['last_name']) ? $userData->user['last_name'] : '',
            'email' =>  !empty($userData->email) ? $userData->email : '',
            'status' =>  1,
        ]);


        if(!empty($user) && !empty($userData->avatar)){
            $name = time() .'.jpg';
            $path = public_path() . '/files/avatar/';
            File::makeDirectory($path, $mode = 0777, true);
            Image::make($userData->avatar)->save($path.$name);
            
            $user->avatar = $name;
            $user->save();
        }

        return $user;
    }
}