<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Welcome
|--------------------------------------------------------------------------
*/

Route::get('/', function () {

    return redirect()->route('profiles.index');

});

/*
|--------------------------------------------------------------------------
| Profile Routes
|--------------------------------------------------------------------------
*/

Route::get('/profiles', [ProfileController::class, 'index'])
    ->name('profiles.index');

Route::get('/profiles/create', [ProfileController::class, 'create'])
    ->name('profiles.create');

Route::post('/profiles/store', [ProfileController::class, 'store'])
    ->name('profiles.store');

Route::get('/profiles/archive', [ProfileController::class, 'archive'])
    ->name('profiles.archive');

Route::get('/profiles/{id}', [ProfileController::class, 'show'])
    ->name('profiles.show');

Route::get('/profiles/{id}/edit', [ProfileController::class, 'edit'])
    ->name('profiles.edit');

Route::put('/profiles/{id}', [ProfileController::class, 'update'])
    ->name('profiles.update');

Route::delete('/profiles/{id}', [ProfileController::class, 'destroy'])
    ->name('profiles.destroy');

/*
|--------------------------------------------------------------------------
| IMPORTANT FIX
|--------------------------------------------------------------------------
| GET method add kari didho
*/

Route::get('/profiles/{id}/archive', [ProfileController::class, 'archivePost'])
    ->name('profiles.archive.post');

/*
|--------------------------------------------------------------------------
| Facebook Login
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
| Facebook Callback
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
| Dashboard
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {

    $user = Auth::user();

    return view('dashboard', compact('user'));

})->middleware('auth');