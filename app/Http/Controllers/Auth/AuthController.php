<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\ThirdPartyLoginInterface;
use App\Http\Repos\GithubRepository;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    private $githubRepo;

    public function __construct(ThirdPartyLoginInterface $github)
    {
        $this->githubRepo = $github;
    }

    public function redirect()
    {
        return $this->githubRepo->redirect();
    }

    public function callback()
    {
        try {
            
            $loggedUser = $this->githubRepo->callback();
            Auth::login($loggedUser);
            dd($loggedUser);

        } catch (\Exception $th) {

            dd($th->getMessage());
            
        }
    }
}
