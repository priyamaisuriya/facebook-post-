<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use Illuminate\Support\Facades\Http;

class ProfileController extends Controller
{

    // Display All Profiles

    public function index()
    {
        $profiles = Profile::latest()->get();

        return view('index', compact('profiles'));
    }


    // Create Page

    public function create()
    {
        return view('create');
    }


    // Store Profile

    // public function store(Request $request)
    // {

    //     $request->validate([

    //         'name' => 'required',
    //         'email' => 'required|email',
    //         'description' => 'required',
    //         'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',

    //     ]);

    //     $imageName = null;

    //     if ($request->hasFile('image')) {

    //         $imageName = time() . '.' . $request->image->extension();

    //         $request->image->move(public_path('profile_images'), $imageName);

    //     }

    //     Profile::create([

    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'description' => $request->description,
    //         'image' => $imageName,

    //     ]);

    //     return redirect()->route('profiles.index')
    //         ->with('success', 'Profile Created Successfully');

    // }
public function store(Request $request)
{
    $request->validate([

        'name' => 'required',
        'email' => 'required|email',
        'description' => 'required',
        'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',

    ]);

    $imageName = null;

    if ($request->hasFile('image')) {

        $imageName = time() . '.' . $request->image->extension();

        $request->image->move(public_path('profile_images'), $imageName);
    }

    $profile = Profile::create([

        'name' => $request->name,
        'email' => $request->email,
        'description' => $request->description,
        'image' => $imageName,

    ]);

    $imagePath = public_path('profile_images/' . $profile->image);

    Http::attach(
        'source',
        file_get_contents($imagePath),
        $profile->image
    )->post(
        'https://graph.facebook.com/' .
        env('FACEBOOK_PAGE_ID') .
        '/photos',
        [

            'caption' =>
                "🔥 New Profile Added\n\n" .
                "Name: " . $profile->name . "\n" .
                "Email: " . $profile->email . "\n" .
                "Description: " . $profile->description,

            'access_token' =>
                env('FACEBOOK_PAGE_ACCESS_TOKEN'),
        ]
    );

    return redirect()->route('profiles.index')
        ->with('success', 'Profile Created Successfully');
}
    public function show($id)
    {

        $profile = Profile::findOrFail($id);

        return view('view', compact('profile'));

    }


    // Edit Page

    public function edit($id)
    {

        $profile = Profile::findOrFail($id);

        return view('edit', compact('profile'));

    }


    // Update Profile

    public function update(Request $request, $id)
    {

        $profile = Profile::findOrFail($id);

        $request->validate([

            'name' => 'required',
            'email' => 'required|email',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

        ]);

        $imageName = $profile->image;

        if ($request->hasFile('image')) {

            // Old Image Delete

            if (
                $profile->image &&
                file_exists(public_path('profile_images/' . $profile->image))
            ) {

                unlink(public_path('profile_images/' . $profile->image));

            }

            // New Image Upload

            $imageName = time() . '.' . $request->image->extension();

            $request->image->move(public_path('profile_images'), $imageName);

        }

        $profile->update([

            'name' => $request->name,
            'email' => $request->email,
            'description' => $request->description,
            'image' => $imageName,

        ]);

        return redirect()->route('profiles.index')
            ->with('success', 'Profile Updated Successfully');

    }


    // Delete Profile

    public function destroy($id)
    {

        $profile = Profile::findOrFail($id);

        // Delete Image

        if (
            $profile->image &&
            file_exists(public_path('profile_images/' . $profile->image))
        ) {

            unlink(public_path('profile_images/' . $profile->image));

        }

        // Delete Data

        $profile->delete();

        return redirect()->route('profiles.index')
            ->with('success', 'Profile Deleted Successfully');

    }

}