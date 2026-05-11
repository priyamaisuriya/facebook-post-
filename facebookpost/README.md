# Laravel Facebook Auto Post Project Documentation

# Project Definition

This project is developed using the Laravel Framework.
Users can create profiles and upload multiple images and videos.

When a user uploads an image or video:

* The file is stored on the server
* Data is saved in the database
* The image or video is automatically posted to a Facebook Page

This project uses CRUD operations and Facebook Graph API integration.

---

# Main Features

✅ Create Profile
✅ Edit Profile
✅ Delete Profile
✅ Multiple Image Upload
✅ Multiple Video Upload
✅ Facebook Auto Image Post
✅ Facebook Auto Video Post
✅ Image & Video Preview
✅ Validation
✅ Responsive UI

---

# Technologies Used

* Laravel 12
* PHP 8
* MySQL
* Facebook Graph API
* HTML
* CSS
* Blade Template
* ngrok

---

# STEP 1 — Create Laravel Project

```bash id="tt8kzv"
composer create-project laravel/laravel facebookpost
```

Definition:

This command creates a new Laravel project.

---

# STEP 2 — Open Project Folder

```bash id="vlnj0j"
cd facebookpost
```

Definition:

Used to open the Laravel project folder.

---

# STEP 3 — Start XAMPP

Start:

* Apache
* MySQL

Definition:

Database connection is required for Laravel.

---

# STEP 4 — Create Database

Open:

```text id="v0gk6z"
http://localhost/phpmyadmin
```

Create database:

```text id="m7r6xn"
facebookpost
```

Definition:

This database stores profile data.

---

# STEP 5 — Configure .env File

```env id="ewb5c7"
DB_DATABASE=facebookpost
DB_USERNAME=root
DB_PASSWORD=
```

Definition:

Used to connect Laravel with MySQL database.

---

# STEP 6 — Create Model and Migration

```bash id="m7pt0n"
php artisan make:model Profile -m
```

Definition:

* Model handles database data
* Migration creates table structure

---

# STEP 7 — Create Database Fields

Migration file:

```php id="j9z4xh"
Schema::create('profiles', function (Blueprint $table) {

    $table->id();

    $table->string('name');

    $table->string('email');

    $table->text('description');

    $table->string('image')->nullable();

    $table->string('video')->nullable();

    $table->timestamps();
});
```

Definition:

These fields are created in the database table.

---

# STEP 8 — Run Migration

```bash id="xz80ow"
php artisan migrate
```

Definition:

Runs the migration and creates the table in the database.

---

# STEP 9 — Create Controller

```bash id="wtrn3r"
php artisan make:controller ProfileController
```

Definition:

The controller handles user requests.

---

# STEP 10 — Add Routes

routes/web.php

```php id="xyd8mv"
Route::resource('profiles', ProfileController::class);
```

Definition:

Automatically creates CRUD routes.

---

# STEP 11 — Create Upload Folders

Create folders:

```text id="7m9uxs"
public/uploads/profiles

public/uploads/videos
```

Definition:

Used to store uploaded images and videos.

---

# STEP 12 — Create Facebook Developer App

Open:

```text id="nyhm5s"
https://developers.facebook.com/
```

Create App.

Definition:

A Facebook App is required to use Facebook APIs.

---

# STEP 13 — Add Facebook Permissions

Required permissions:

* pages_manage_posts
* pages_show_list
* pages_read_engagement

Definition:

These permissions allow posting on Facebook pages.

---

# STEP 14 — Generate Page Access Token

Use Graph API Explorer.

Definition:

Access token is required for Facebook API authentication.

---

# STEP 15 — Add Facebook Credentials

.env file:

```env id="s0e8yy"
FACEBOOK_PAGE_ID=YOUR_PAGE_ID

FACEBOOK_PAGE_ACCESS_TOKEN=YOUR_ACCESS_TOKEN
```

Definition:

Connects Laravel project with Facebook Page.

---

# STEP 16 — Generate Image Name

```php id="k0m4jq"
$imageName =
time().
rand(100,999).
'.'.
$image->getClientOriginalExtension();
```

Definition:

Creates a unique image filename.

---

# STEP 17 — Move Image

```php id="k0og38"
$image->move(
    public_path('uploads/profiles'),
    $imageName
);
```

Definition:

Uploads image into the server folder.

---

# STEP 18 — Generate Video Name

```php id="e77rmu"
$videoName =
time().
rand(100,999).
'.'.
$video->getClientOriginalExtension();
```

Definition:

Creates a unique video filename.

---

# STEP 19 — Move Video

```php id="j1y8wj"
$video->move(
    public_path('uploads/videos'),
    $videoName
);
```

Definition:

Uploads video into the server folder.

---

# STEP 20 — Facebook Image Upload

```php id="a3w2gc"
Http::attach(
    'source',
    file_get_contents($imagePath),
    $imageName
)->post(
    'https://graph.facebook.com/v19.0/PAGE_ID/photos',
    [
        'caption' => 'New Image',
        'access_token' => TOKEN,
    ]
);
```

Definition:

Automatically posts image to Facebook Page.

---

# STEP 21 — Facebook Video Upload

```php id="a3aw25"
Http::timeout(0)
    ->attach(
        'source',
        fopen($videoPath,'r'),
        $videoName
    )
    ->post(
        'https://graph-video.facebook.com/v19.0/PAGE_ID/videos',
        [
            'description' => 'New Video',
            'access_token' => TOKEN,
        ]
    );
```

Definition:

Automatically uploads video to Facebook Page.

---

# STEP 22 — Validation

```php id="z9q8c1"
$request->validate([

    'images' => 'required_without:videos',

    'videos' => 'required_without:images',

]);
```

Definition:

At least one image or video is required.

---

# STEP 23 — Start Laravel Server

```bash id="ql5jja"
php artisan serve
```

Definition:

Runs the Laravel project locally.

Output:

```text id="4m3h0r"
http://127.0.0.1:8000
```

---

# STEP 24 — Start ngrok

```bash id="brm2wi"
ngrok http 8000
```

Definition:

Converts localhost into a public URL.

Example:

```text id="gptvk4"
https://abc.ngrok-free.app
```

---

# STEP 25 — Open Project

Open browser:

```text id="quc0e8"
https://abc.ngrok-free.app/profiles
```

Definition:

Opens the project in browser.

---

# STEP 26 — Test Upload

1. Create profile
2. Upload image/video
3. Submit form

Definition:

Data will be stored in database and automatically posted on Facebook Page.

---

# Common Errors

## 404 Error

Reason:

Wrong image path.

Fix:

```php id="vqk9og"
asset('uploads/profiles/'.$profile->image)
```

---

## Missing or Invalid Image File

Reason:

Facebook cannot access the image.

Fix:

Use ngrok public URL.

---

## Unknown Column 'video'

Reason:

Database column does not exist.

Fix:

Run migration.

---

# Important Commands

```bash id="4x6v9k"
php artisan serve

php artisan migrate

ngrok http 8000
```

---

# Final Result

✅ CRUD System Ready
✅ Multiple Image Upload
✅ Multiple Video Upload
✅ Facebook Auto Posting
✅ Database Storage
✅ Responsive UI
✅ Laravel Project Successfully Running
