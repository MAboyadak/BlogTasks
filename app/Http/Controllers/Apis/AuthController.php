<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Traits\Responses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    use Responses;

    public function Login(LoginUserRequest $request){
        
        $request->validated($request->all());

        if(!Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            return $this->error('','Credentials don\'t match', 401);
        }

        $loggedUser = User::where('email',$request->email)->first(); 
        return $this->success([
            'user' => $loggedUser,
            'token' => $loggedUser->createToken('New Api Token')->plainTextToken,
        ]);

    }

    public function register(StoreUserRequest $request){
        
        $request->validated($request->all());

        $newUser = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return $this->success([
            'user' => $newUser, 
            'token' => $newUser->createToken('API Token of ' . $newUser->name)->plainTextToken
        ]);

    }

    public function Logout(){
        Auth::user()->currentAccessToken()->delete();

        return $this->success([],'You Have Just Logged Out');
    }

}
