<?php

namespace App\Providers;

use App\Repositories\UserRepository;
use App\Repositories\UserRepositoryEloquent;
use App\Repositories\Author\AuthorRepositoryInterface;
use App\Repositories\Author\AuthorEloquentRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            AuthorRepositoryInterface::class,
            AuthorEloquentRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \App::bind(UserRepository::class, UserRepositoryEloquent::class);
    }
}
