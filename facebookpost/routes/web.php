<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {

    return view('welcome');

});


/*
|--------------------------------------------------------------------------
| Profile CRUD Routes
|--------------------------------------------------------------------------
*/

Route::resource('profiles', ProfileController::class);


/*
|--------------------------------------------------------------------------
| Facebook Login Route
|--------------------------------------------------------------------------
*/

Route::get('/auth/facebook', function () {

    return Socialite::driver('facebook')
        ->scopes([
            'email',
            'pages_show_list',
            'pages_manage_posts',
            'pages_read_engagement'
        ])
        ->redirect();

});


/*
|--------------------------------------------------------------------------
| Facebook Callback Route
|--------------------------------------------------------------------------
*/

Route::get('/auth/facebook/callback', function () {

    $facebookUser = Socialite::driver('facebook')
        ->stateless()
        ->user();

    $user = User::updateOrCreate(

        [
            'email' => $facebookUser->email
        ],

        [
            'name' => $facebookUser->name,

            'facebook_id' => $facebookUser->id,

            'avatar' => $facebookUser->avatar,

            'password' => bcrypt('facebook123'),
        ]

    );

    Auth::login($user);

    return redirect('/dashboard');

});


/*
|--------------------------------------------------------------------------
| Dashboard Route
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {

    $user = Auth::user();

    return view('dashboard', compact('user'));

})->middleware('auth');