<?php

namespace App\Http\Repos;

use App\Http\Interfaces\ThirdPartyLoginInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class GithubRepository implements ThirdPartyLoginInterface{

    public function redirect(){
        return Socialite::driver('github')->stateless()->redirect();
    }

    public function callback(){
        
        $githubUser = Socialite::driver('github')->stateless()->user();
        // dd($githubUser);
        return $user = User::updateOrCreate([
            'github_id' => $githubUser->id,
        ], [
            'name' => $githubUser->name,
            'nickname' => $githubUser->nickname,
            'email' => $githubUser->email,
            'github_token' => $githubUser->token,
            'auth_type' => 'github',
            'github_refresh_token' => $githubUser->refreshToken,
            'password'  =>  Hash::make(Str::random(5))
        ]);

    }



}





?>