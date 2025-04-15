<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use function PHPUnit\Framework\isArray;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
       Gate::define('create_post',function (User $user){
        return in_array($user->role,['admin','writer']);
       });
       Gate::define('delete_post',function (User $user){
        return $user->role==='admin';
       });
       Gate::define('edit_post',function (User $user,Post $post){
        return $user->id===$post->user_id || $user->role==='admin';
       });
       Paginator::useBootstrapFive();
    }
}
