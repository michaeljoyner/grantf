<?php

namespace App\Providers;

use App\Exceptions\LastUserDeletionException;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        User::deleting(function($user) {
           if(User::count() < 2) {
               throw new LastUserDeletionException;
           }
        });

        Validator::extend('password', function($attribute, $value, $parameters, $validator) {
            return Hash::check($value, Auth::user()->password);
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
