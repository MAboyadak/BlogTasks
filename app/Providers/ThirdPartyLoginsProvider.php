<?php

namespace App\Providers;

use App\Http\Interfaces\ThirdPartyLoginInterface;
use App\Http\Repos\GithubRepository;
use Illuminate\Support\ServiceProvider;

class ThirdPartyLoginsProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ThirdPartyLoginInterface::class, GithubRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
    }
}
