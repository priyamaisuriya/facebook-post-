<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use Illuminate\Support\Facades\Http;

class ProfileController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $profiles = Profile::latest()->get();

        return view('index', compact('profiles'));
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        return view('create');
    }

    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        set_time_limit(0);

        $request->validate([

            'name'        => 'required',
            'email'       => 'required|email',
            'description' => 'required',
            'status'      => 'required',

            'images.*' =>
                'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'videos.*' =>
                'nullable|mimes:mp4,mov,avi|max:51200',

        ]);

        /*
        |--------------------------------------------------------------------------
        | SAVE PROFILE
        |--------------------------------------------------------------------------
        */

        $profile = new Profile();

        $profile->name =
            $request->name;

        $profile->email =
            $request->email;

        $profile->description =
            $request->description;

        $profile->hashtags =
            $request->hashtags;

        $profile->tags =
            $request->tags;

        $profile->status =
            $request->status;

        $profile->schedule_time =
            $request->schedule_time;

        $profile->save();

        /*
        |--------------------------------------------------------------------------
        | FACEBOOK DETAILS
        |--------------------------------------------------------------------------
        */

        $pageId =
            env('FACEBOOK_PAGE_ID');

        $token =
            env('FACEBOOK_PAGE_ACCESS_TOKEN');

        /*
        |--------------------------------------------------------------------------
        | IMAGE UPLOAD
        |--------------------------------------------------------------------------
        */

        if($request->hasFile('images')){

            $allImages = [];

            foreach($request->file('images') as $image){

                $imageName =
                    time() .
                    rand(100,999) .
                    '.' .
                    $image->getClientOriginalExtension();

                $image->move(

                    public_path('uploads/profiles'),

                    $imageName

                );

                $allImages[] =
                    $imageName;

                /*
                |--------------------------------------------------------------------------
                | FACEBOOK IMAGE POST
                |--------------------------------------------------------------------------
                */

                if($pageId && $token){

                    try{

                        $fbResponse = Http::attach(

                            'source',

                            fopen(
                                public_path(
                                    'uploads/profiles/' .
                                    $imageName
                                ),
                                'r'
                            ),

                            $imageName

                        )->post(

                            'https://graph.facebook.com/v22.0/' .
                            $pageId .
                            '/photos',

                            [

                                'caption' =>

                                    "🔥 " .
                                    $profile->description .
                                    "\n\n" .
                                    $profile->hashtags .
                                    "\n\n" .
                                    $profile->tags,

                                'access_token' =>
                                    $token,

                            ]

                        );

                        $fbJson =
                            $fbResponse->json();

                        /*
                        |--------------------------------------------------------------------------
                        | FACEBOOK ERROR
                        |--------------------------------------------------------------------------
                        */

                        if(isset($fbJson['error'])){

                            return back()->with(

                                'error',

                                $fbJson['error']['message']

                            );
                        }

                        /*
                        |--------------------------------------------------------------------------
                        | FACEBOOK SUCCESS
                        |--------------------------------------------------------------------------
                        */

                        if(isset($fbJson['post_id'])){

                            $profile->facebook_post_id =
                                $fbJson['post_id'];

                            $profile->facebook_post_url =
                                "https://facebook.com/" .
                                $fbJson['post_id'];

                            $profile->save();
                        }

                    }catch(\Exception $e){

                        return back()->with(

                            'error',

                            $e->getMessage()

                        );
                    }
                }
            }

            $profile->images =
                json_encode($allImages);

            $profile->save();
        }

        /*
        |--------------------------------------------------------------------------
        | VIDEO UPLOAD
        |--------------------------------------------------------------------------
        */

        if($request->hasFile('videos')){

            $allVideos = [];

            foreach($request->file('videos') as $video){

                $videoName =
                    time() .
                    rand(100,999) .
                    '.' .
                    $video->getClientOriginalExtension();

                $video->move(

                    public_path('uploads/videos'),

                    $videoName

                );

                $allVideos[] =
                    $videoName;

                /*
                |--------------------------------------------------------------------------
                | FACEBOOK VIDEO POST
                |--------------------------------------------------------------------------
                */

                if($pageId && $token){

                    try{

                        $videoResponse = Http::timeout(0)

                            ->attach(

                                'source',

                                fopen(
                                    public_path(
                                        'uploads/videos/' .
                                        $videoName
                                    ),
                                    'r'
                                ),

                                $videoName

                            )

                            ->post(

                                'https://graph-video.facebook.com/v22.0/' .
                                $pageId .
                                '/videos',

                                [

                                    'description' =>

                                        $profile->description .
                                        "\n\n" .
                                        $profile->hashtags .
                                        "\n\n" .
                                        $profile->tags,

                                    'access_token' =>
                                        $token,

                                ]

                            );

                        $videoJson =
                            $videoResponse->json();

                        if(isset($videoJson['error'])){

                            return back()->with(

                                'error',

                                $videoJson['error']['message']

                            );
                        }

                        if(isset($videoJson['id'])){

                            $profile->facebook_post_id =
                                $videoJson['id'];

                            $profile->facebook_post_url =
                                "https://facebook.com/" .
                                $videoJson['id'];

                            $profile->save();
                        }

                    }catch(\Exception $e){

                        return back()->with(

                            'error',

                            $e->getMessage()

                        );
                    }
                }
            }

            $profile->videos =
                json_encode($allVideos);

            $profile->save();
        }

        /*
        |--------------------------------------------------------------------------
        | SAVE PLATFORM
        |--------------------------------------------------------------------------
        */

        if($request->platforms){

            $profile->platforms =
                json_encode(
                    $request->platforms
                );

            $profile->save();
        }

        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */

        return redirect()

            ->route('profiles.index')

            ->with(

                'success',

                '✅ Profile Created Successfully'

            );
    }

    /*
    |--------------------------------------------------------------------------
    | SHOW
    |--------------------------------------------------------------------------
    */

    public function show($id)
    {
        $profile =
            Profile::findOrFail($id);

        return view(
            'show',
            compact('profile')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        $profile =
            Profile::findOrFail($id);

        return view(
            'edit',
            compact('profile')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, $id)
    {
        $profile =
            Profile::findOrFail($id);

        $request->validate([

            'name'        => 'required',
            'email'       => 'required|email',
            'description' => 'required',
            'status'      => 'required',

        ]);

        $profile->name =
            $request->name;

        $profile->email =
            $request->email;

        $profile->description =
            $request->description;

        $profile->hashtags =
            $request->hashtags;

        $profile->tags =
            $request->tags;

        $profile->status =
            $request->status;

        $profile->schedule_time =
            $request->schedule_time;

        $profile->save();

        return redirect()

            ->route('profiles.index')

            ->with(

                'success',

                '✅ Profile Updated Successfully'

            );
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
    */

    public function destroy($id)
    {
        $profile =
            Profile::findOrFail($id);

        if($profile->images){

            $images =
                json_decode($profile->images);

            foreach($images as $image){

                $path =
                    public_path(
                        'uploads/profiles/' .
                        $image
                    );

                if(file_exists($path)){

                    unlink($path);
                }
            }
        }

        if($profile->videos){

            $videos =
                json_decode($profile->videos);

            foreach($videos as $video){

                $path =
                    public_path(
                        'uploads/videos/' .
                        $video
                    );

                if(file_exists($path)){

                    unlink($path);
                }
            }
        }

        $profile->delete();

        return redirect()

            ->route('profiles.index')

            ->with(

                'success',

                '🗑 Profile Deleted Successfully'

            );
    }

    /*
    |--------------------------------------------------------------------------
    | ARCHIVE PAGE
    |--------------------------------------------------------------------------
    */

    public function archive()
    {
        $profiles = Profile::where(
            'status',
            'archive'
        )->latest()->get();

        return view(
            'archive',
            compact('profiles')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | ARCHIVE POST
    |--------------------------------------------------------------------------
    */

    public function archivePost($id)
    {
        $profile =
            Profile::findOrFail($id);

        $profile->status =
            'archive';

        $profile->save();

        return redirect()

            ->route('profiles.archive')

            ->with(

                'success',

                '📦 Post Archived Successfully'

            );
    }
}