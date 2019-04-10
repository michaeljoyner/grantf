<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


use App\Blog\Post;

Route::get('/', 'PagesController@home');
Route::get('conservation', 'PagesController@conservation');
Route::get('speaking', 'PagesController@speaking');
Route::get('consultant', 'PagesController@consultant');

Route::get('blog', 'PagesController@blog');
Route::get('blog/{slug}', 'PagesController@post');

Route::get('contact', 'ContactController@show');
Route::post('contact', 'ContactController@postMessage');

Route::post('newsletter/subscribe', 'NewsletterSubscriptionsController@subscribe');
Route::post('newsletter/unsubscribe', 'NewsletterSubscriptionsController@unsubscribe');

Route::get('mailinglist/unsubscribe', 'PagesController@mailingListUnsubscribe');

Route::get('api/blog', function() {
    return App\Blog\Post::all();
});

// Authentication Routes...
Route::get('admin/login', 'Auth\AuthController@showLoginForm');
Route::post('admin/login', 'Auth\AuthController@login');
Route::get('admin/logout', 'Auth\AuthController@logout');

// Registration Routes...
Route::post('admin/users/register', 'Auth\AuthController@register');

// Password Reset Routes...
Route::get('admin/password/reset/{token?}', 'Auth\PasswordController@showResetForm');
Route::post('admin/password/email', 'Auth\PasswordController@sendResetLinkEmail');
Route::post('admin/password/reset', 'Auth\PasswordController@reset');

Route::get('admin/users/password/reset', 'Auth\PasswordController@showLoggedInUserPasswordReset');
Route::post('admin/users/password/reset', 'Auth\PasswordController@loggedInUserReset');


Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {

    Route::group(['middleware' => 'auth'], function () {
        Route::get('/', 'PagesController@dashboard');

        Route::get('users', 'UsersController@index');
        Route::get('users/{user}/edit', 'UsersController@edit');
        Route::post('users/{user}', 'UsersController@update');
        Route::delete('users/{user}', 'UsersController@delete');

        Route::get('blog/posts', 'BlogPostsController@index');
        Route::get('blog/posts/create', 'BlogPostsController@create');
        Route::post('blog/posts', 'BlogPostsController@store');
        Route::get('blog/posts/{post}/edit', 'BlogPostsController@edit');
        Route::post('blog/posts/{post}', 'BlogPostsController@update');
        Route::delete('blog/posts/{post}', 'BlogPostsController@delete');

        Route::post('blog/posts/{post}/images', 'BlogPostImagesController@store');
        Route::post('blog/posts/{post}/publish', 'BlogPostsController@publish');

        Route::get('events', 'EventsController@index');
        Route::get('events/create', 'EventsController@create');
        Route::post('events', 'EventsController@store');
        Route::get('events/{event}/edit', 'EventsController@edit');
        Route::post('events/{event}', 'EventsController@update');
        Route::delete('events/{event}', 'EventsController@delete');

        Route::get('conservation', 'ConservationProjectsController@index');
        Route::get('conservation/create', 'ConservationProjectsController@create');
        Route::get('conservation/{writeup}', 'ConservationProjectsController@show');
        Route::post('conservation', 'ConservationProjectsController@store');
        Route::get('conservation/{writeup}/edit', 'ConservationProjectsController@edit');
        Route::post('conservation/{writeup}', 'ConservationProjectsController@update');
        Route::delete('conservation/{writeup}', 'ConservationProjectsController@delete');

        Route::get('speaking', 'TalksController@index');
        Route::get('speaking/create', 'TalksController@create');
        Route::get('speaking/{writeup}', 'TalksController@show');
        Route::post('speaking', 'TalksController@store');
        Route::get('speaking/{writeup}/edit', 'TalksController@edit');
        Route::post('speaking/{writeup}', 'TalksController@update');
        Route::delete('speaking/{writeup}', 'TalksController@delete');

        Route::get('consulting', 'ConsultationProjectsController@index');
        Route::get('consulting/create', 'ConsultationProjectsController@create');
        Route::get('consulting/{writeup}', 'ConsultationProjectsController@show');
        Route::post('consulting', 'ConsultationProjectsController@store');
        Route::get('consulting/{writeup}/edit', 'ConsultationProjectsController@edit');
        Route::post('consulting/{writeup}', 'ConsultationProjectsController@update');
        Route::delete('consulting/{writeup}', 'ConsultationProjectsController@delete');

        Route::post('writeups/{writeup}/image', 'WriteupImagesController@storeImage');

        Route::get('affiliates', 'AffiliatesController@index');
        Route::get('affiliates/{affiliate}', 'AffiliatesController@show');
        Route::post('affiliates', 'AffiliatesController@store');
        Route::get('affiliates/{affiliate}/edit', 'AffiliatesController@edit');
        Route::post('affiliates/{affiliate}', 'AffiliatesController@update');
        Route::delete('affiliates/{affiliate}', 'AffiliatesController@delete');
        Route::post('affiliates/{affiliate}/image', 'AffiliatesController@setImage');

        Route::get('newsletter', 'NewsletterController@index');


    });

});