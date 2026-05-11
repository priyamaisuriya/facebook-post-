<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use Illuminate\Support\Facades\Http;

class ProfileController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | DISPLAY ALL PROFILES
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $profiles = Profile::latest()->get();

        return view('index', compact('profiles'));
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE PAGE
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        return view('create');
    }

    /*
    |--------------------------------------------------------------------------
    | STORE PROFILE
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        set_time_limit(0);

        /*
        |--------------------------------------------------------------------------
        | VALIDATION
        |--------------------------------------------------------------------------
        */

        $request->validate([

            'name'        => 'required',
            'email'       => 'required|email',
            'description' => 'required',

            'images' => 'required_without:videos',
            'videos' => 'required_without:images',

            'images.*' =>
                'image|mimes:jpg,jpeg,png,webp|max:2048',

            'videos.*' =>
                'mimes:mp4,mov,avi|max:51200',
        ]);

        /*
        |--------------------------------------------------------------------------
        | SAVE PROFILE
        |--------------------------------------------------------------------------
        */

        $profile = Profile::create([

            'name'        => $request->name,
            'email'       => $request->email,
            'description' => $request->description,

        ]);

        /*
        |--------------------------------------------------------------------------
        | MULTIPLE IMAGE UPLOAD
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('images')) {

            foreach ($request->file('images') as $image) {

                /*
                |--------------------------------------------------------------------------
                | IMAGE NAME FIX
                |--------------------------------------------------------------------------
                */

                $imageName =
                    time() .
                    rand(100,999) .
                    '.' .
                    $image->getClientOriginalExtension();

                /*
                |--------------------------------------------------------------------------
                | MOVE IMAGE
                |--------------------------------------------------------------------------
                */

                $image->move(
                    public_path('uploads/profiles'),
                    $imageName
                );

                /*
                |--------------------------------------------------------------------------
                | SAVE IMAGE DATABASE
                |--------------------------------------------------------------------------
                */

                $profile->image = $imageName;

                $profile->save();

                /*
                |--------------------------------------------------------------------------
                | FACEBOOK IMAGE POST
                |--------------------------------------------------------------------------
                */

                Http::attach(
                    'source',
                    file_get_contents(
                        public_path(
                            'uploads/profiles/' . $imageName
                        )
                    ),
                    $imageName
                )->post(
                    'https://graph.facebook.com/v19.0/' .
                    env('FACEBOOK_PAGE_ID') .
                    '/photos',
                    [
                        'caption' =>
                            "New Profile Uploaded\n\n" .
                            "Name : " . $profile->name . "\n" .
                            "Email : " . $profile->email . "\n" .
                            "Description : " . $profile->description,

                        'access_token' =>
                            env('FACEBOOK_PAGE_ACCESS_TOKEN'),
                    ]
                );
            }
        }

        /*
        |--------------------------------------------------------------------------
        | MULTIPLE VIDEO UPLOAD
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('videos')) {

            foreach ($request->file('videos') as $video) {

                /*
                |--------------------------------------------------------------------------
                | VIDEO NAME FIX
                |--------------------------------------------------------------------------
                */

                $videoName =
                    time() .
                    rand(100,999) .
                    '.' .
                    $video->getClientOriginalExtension();

                /*
                |--------------------------------------------------------------------------
                | MOVE VIDEO
                |--------------------------------------------------------------------------
                */

                $video->move(
                    public_path('uploads/videos'),
                    $videoName
                );

                /*
                |--------------------------------------------------------------------------
                | SAVE VIDEO DATABASE
                |--------------------------------------------------------------------------
                */

                $profile->video = $videoName;

                $profile->save();

                $videoPath =
                    public_path(
                        'uploads/videos/' . $videoName
                    );

                /*
                |--------------------------------------------------------------------------
                | FACEBOOK VIDEO POST
                |--------------------------------------------------------------------------
                */

                Http::timeout(0)
                    ->attach(
                        'source',
                        fopen($videoPath, 'r'),
                        $videoName
                    )
                    ->post(
                        'https://graph-video.facebook.com/v19.0/' .
                        env('FACEBOOK_PAGE_ID') .
                        '/videos',
                        [
                            'description' =>
                                "New Video Uploaded\n\n" .
                                "Name : " . $profile->name,

                            'access_token' =>
                                env('FACEBOOK_PAGE_ACCESS_TOKEN'),
                        ]
                    );
            }
        }

        /*
        |--------------------------------------------------------------------------
        | SUCCESS
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('profiles.index')
            ->with(
                'success',
                'Profile Created Successfully'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | SHOW PROFILE
    |--------------------------------------------------------------------------
    */

    public function show($id)
    {
        $profile = Profile::findOrFail($id);

        return view('view', compact('profile'));
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT PAGE
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        $profile = Profile::findOrFail($id);

        return view('edit', compact('profile'));
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE PROFILE
    |--------------------------------------------------------------------------
    */

    public function destroy($id)
    {
        $profile = Profile::findOrFail($id);

        if (
            $profile->image &&
            file_exists(
                public_path(
                    'uploads/profiles/' . $profile->image
                )
            )
        ) {

            unlink(
                public_path(
                    'uploads/profiles/' . $profile->image
                )
            );
        }

        if (
            $profile->video &&
            file_exists(
                public_path(
                    'uploads/videos/' . $profile->video
                )
            )
        ) {

            unlink(
                public_path(
                    'uploads/videos/' . $profile->video
                )
            );
        }

        $profile->delete();

        return redirect()
            ->route('profiles.index')
            ->with(
                'success',
                'Profile Deleted Successfully'
            );
    }
}