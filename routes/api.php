<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('logout', 'Auth\LoginController@logout');

    Route::get('/user', 'Auth\UserController@current');
    Route::get('/users/names', 'Auth\UserController@names');

    Route::patch('settings/profile', 'Settings\ProfileController@update');
    Route::patch('settings/password', 'Settings\PasswordController@update');

    Route::get('/projects', 'ImageController@index');
    Route::get('/projects/{id}', 'ImageController@getProject');
    Route::post('/projects', 'ImageController@store');
    Route::patch('/projects/{project}', 'ImageController@update');
    Route::delete('/projects/{project}', 'ImageController@destroy');
    Route::post('/projects/ranking/{category}', 'ImageController@getRankedProjects');

    Route::get('/categories', 'CategoryController@index');

    Route::get('/likes', 'LikeController@index');
    Route::post('/likes', 'LikeController@store');
    Route::delete('/likes/{like}', 'LikeController@destroy');

    Route::get('/games', 'GameController@index');
    Route::post('/games/init/{category}', 'GameController@init');
    Route::patch('/games/update', 'GameController@update');
});

Route::group(['middleware' => 'guest:api'], function () {
    Route::post('login', 'Auth\LoginController@login');
    Route::post('register', 'Auth\RegisterController@register');

    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');

    Route::post('email/verify/{user}', 'Auth\VerificationController@verify')->name('verification.verify');
    Route::post('email/resend', 'Auth\VerificationController@resend');

    Route::post('oauth/{driver}', 'Auth\OAuthController@redirectToProvider');
    Route::get('oauth/{driver}/callback', 'Auth\OAuthController@handleProviderCallback')->name('oauth.callback');
});
