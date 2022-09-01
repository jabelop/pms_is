<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Repositories\User\UserRepository;
use App\Http\Repositories\User\UserRepositoryImpl;
use App\Models\User;
use App\Models\Project;
use App\Models\Activity;
use App\Models\Incidence;
use App\Http\Helpers\Response;
use App\Http\Helpers\ApiResponse;
use App\Http\Repositories\Project\ProjectRepository;
use App\Http\Repositories\Project\ProjectRepositoryImpl;
use App\Http\Repositories\Activity\ActivityRepository;
use App\Http\Repositories\Activity\ActivityRepositoryImpl;
use App\Http\Repositories\Incidence\IncidenceRepository;
use App\Http\Repositories\Incidence\IncidenceRepositoryImpl;


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
            'App\Htpp\Repositories\User\UserRepository',
            'App\Http\Repositories\User\UserRepositoryImpl',
            'App\Htpp\Repositories\Project\ProjectRepository',
            'App\Http\Repositories\Project\ProjectRepositoryImpl',
            'App\Http\Repositories\Activity\ActivityRepository',
            'App\Http\Repositories\Activity\ActivityRepositoryImpl',
            'App\Http\Repositories\Incidence\IncidenceRepository',
            'App\Http\Repositories\Incidence\IncidenceRepositoryImpl'
        );

        $this->app->bind(Response::class, function () {
            return new ApiResponse();
        });

        $this->app->bind(UserRepository::class, function () {
            return new UserRepositoryImpl(new User());
        });

        $this->app->bind(ProjectRepository::class, function () {
            return new ProjectRepositoryImpl(new Project());
        });

        $this->app->bind(ActivityRepository::class, function () {
            return new ActivityRepositoryImpl(new Activity());
        });
        $this->app->bind(IncidenceRepository::class, function () {
            return new IncidenceRepositoryImpl(new Incidence());
        });
        
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
