<!-- resources/views/edit.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>
    Edit Profile
</title>

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Segoe UI',sans-serif;
}

body{

    background:
    linear-gradient(
        135deg,
        #dbeafe,
        #eef2ff,
        #f8fafc
    );

    min-height:100vh;

    padding:40px;

    overflow-x:hidden;

    position:relative;
}

.bg1,
.bg2,
.bg3{

    position:absolute;

    border-radius:50%;

    filter:blur(10px);

    z-index:0;
}

.bg1{

    width:350px;
    height:350px;

    background:#bfdbfe;

    top:-100px;
    left:-100px;

    opacity:0.45;
}

.bg2{

    width:260px;
    height:260px;

    background:#c4b5fd;

    bottom:-80px;
    right:-80px;

    opacity:0.35;
}

.bg3{

    width:180px;
    height:180px;

    background:#93c5fd;

    top:50%;
    left:50%;

    transform:translate(-50%,-50%);

    opacity:0.18;
}

.container{

    width:100%;
    max-width:900px;

    margin:auto;

    background:
    rgba(255,255,255,0.95);

    backdrop-filter:blur(14px);

    border-radius:35px;

    padding:45px;

    box-shadow:
    0 20px 60px
    rgba(0,0,0,0.08);

    position:relative;

    z-index:10;
}

.top-title{

    text-align:center;

    margin-bottom:35px;
}

.top-title h2{

    font-size:42px;

    color:#0f172a;

    margin-bottom:10px;
}

.top-title p{

    color:#64748b;

    font-size:17px;
}

.preview-wrapper{

    display:flex;

    justify-content:center;

    margin-bottom:35px;
}

.profile-preview{

    width:170px;
    height:170px;

    border-radius:30px;

    overflow:hidden;

    border:6px solid #dbeafe;

    background:white;

    box-shadow:
    0 15px 35px
    rgba(37,99,235,0.15);
}

.profile-preview img,
.profile-preview video{

    width:100%;
    height:100%;

    object-fit:cover;
}

.form-grid{

    display:grid;

    grid-template-columns:
    1fr 1fr;

    gap:22px;
}

.input-group{

    margin-bottom:24px;
}

.full-width{

    grid-column:1/3;
}

label{

    display:block;

    margin-bottom:10px;

    color:#334155;

    font-weight:700;

    font-size:15px;
}

input,
textarea,
select{

    width:100%;

    padding:16px;

    border-radius:16px;

    border:2px solid #e2e8f0;

    background:#f8fafc;

    font-size:15px;

    transition:0.3s;
}

input:focus,
textarea:focus,
select:focus{

    outline:none;

    border-color:#6366f1;

    background:white;

    box-shadow:
    0 0 15px
    rgba(99,102,241,0.18);
}

textarea{

    resize:none;

    height:150px;
}

.file-box{

    border:2px dashed #93c5fd;

    background:#eff6ff;

    border-radius:22px;

    padding:30px;

    text-align:center;

    transition:0.3s;
}

.file-box:hover{

    background:#dbeafe;
}

.file-box i{

    font-size:40px;

    color:#2563eb;

    margin-bottom:15px;
}

input[type="file"]{

    border:none;

    background:none;

    margin-top:15px;
}

.preview-grid{

    display:flex;

    flex-wrap:wrap;

    gap:15px;

    margin-top:18px;
}

.preview-grid img,
.preview-grid video{

    width:120px;
    height:120px;

    border-radius:18px;

    object-fit:cover;

    border:3px solid #dbeafe;
}

.btn-group{

    display:flex;

    gap:18px;

    margin-top:30px;
}

.update-btn{

    flex:1;

    padding:18px;

    border:none;

    border-radius:18px;

    background:
    linear-gradient(
        135deg,
        #22c55e,
        #16a34a
    );

    color:white;

    font-size:17px;

    font-weight:bold;

    cursor:pointer;

    transition:0.3s;
}

.update-btn:hover{

    transform:translateY(-3px);

    box-shadow:
    0 10px 20px
    rgba(34,197,94,0.25);
}

.back-btn{

    flex:1;

    text-align:center;

    padding:18px;

    border-radius:18px;

    background:
    linear-gradient(
        135deg,
        #6366f1,
        #4f46e5
    );

    color:white;

    text-decoration:none;

    font-weight:bold;

    transition:0.3s;
}

.back-btn:hover{

    transform:translateY(-3px);

    box-shadow:
    0 10px 20px
    rgba(99,102,241,0.25);
}

.alert{

    background:#fee2e2;

    color:#b91c1c;

    padding:15px;

    border-radius:15px;

    margin-bottom:25px;

    font-weight:bold;
}

@media(max-width:768px){

    body{
        padding:20px;
    }

    .container{
        padding:30px;
    }

    .form-grid{
        grid-template-columns:1fr;
    }

    .full-width{
        grid-column:auto;
    }

    .btn-group{
        flex-direction:column;
    }

    .top-title h2{
        font-size:32px;
    }
}

</style>

</head>

<body>

<div class="bg1"></div>
<div class="bg2"></div>
<div class="bg3"></div>

<div class="container">

<div class="top-title">

<h2>
    ✏ Edit Social Profile
</h2>

<p>
    Update Profile Information, Images & Videos
</p>

</div>

@if ($errors->any())

<div class="alert">

@foreach ($errors->all() as $error)

<div>
    • {{ $error }}
</div>

@endforeach

</div>

@endif

<div class="preview-wrapper">

<div class="profile-preview">

@if($profile->images)

<img src="
{{ asset('uploads/profiles/' . json_decode($profile->images)[0]) }}
">

@elseif($profile->videos)

<video controls>

<source src="
{{ asset('uploads/videos/' . json_decode($profile->videos)[0]) }}
">

</video>

@else

<img src="https://via.placeholder.com/170">

@endif

</div>

</div>

<form
action="{{ route('profiles.update',$profile->id) }}"
method="POST"
enctype="multipart/form-data"
>

@csrf
@method('PUT')

<div class="form-grid">

<div class="input-group">

<label>
    Full Name
</label>

<input
type="text"
name="name"
value="{{ $profile->name }}"
placeholder="Enter full name"
required
>

</div>

<div class="input-group">

<label>
    Email Address
</label>

<input
type="email"
name="email"
value="{{ $profile->email }}"
placeholder="Enter email"
required
>

</div>

<div class="input-group full-width">

<label>
    Description
</label>

<textarea
name="description"
placeholder="Write profile description..."
required
>{{ $profile->description }}</textarea>

</div>

<div class="input-group">

<label>
    Tags
</label>

<input
type="text"
name="tags"
value="{{ $profile->tags }}"
placeholder="@john @alex"
>

</div>

<div class="input-group">

<label>
    Hashtags
</label>

<input
type="text"
name="hashtags"
value="{{ $profile->hashtags }}"
placeholder="#viral #trending"
>

</div>

<!-- FIXED STATUS -->

<div class="input-group">

<label>
    Post Status
</label>

<select name="post_status" required>

<option
value="publish"
{{ $profile->status == 'publish' ? 'selected' : '' }}
>
Publish
</option>

<option
value="draft"
{{ $profile->status == 'draft' ? 'selected' : '' }}
>
Draft
</option>

<option
value="archive"
{{ $profile->status == 'archive' ? 'selected' : '' }}
>
Archive
</option>

</select>

</div>

<div class="input-group">

<label>
    Schedule Time
</label>

<input
type="datetime-local"
name="schedule_time"
value="{{ $profile->schedule_time }}"
>

</div>

<div class="input-group full-width">

<label>
    Change Images
</label>

<div class="file-box">

<i class="fa-solid fa-image"></i>

<h3>
    Upload New Images
</h3>

<br>

<input
type="file"
name="images[]"
multiple
accept="image/*"
onchange="previewImages(event)"
>

</div>

<div class="preview-grid"
id="imagePreview">

</div>

</div>

<div class="input-group full-width">

<label>
    Change Videos
</label>

<div class="file-box">

<i class="fa-solid fa-video"></i>

<h3>
    Upload New Videos
</h3>

<br>

<input
type="file"
name="videos[]"
multiple
accept="video/*"
onchange="previewVideos(event)"
>

</div>

<div class="preview-grid"
id="videoPreview">

</div>

</div>

</div>

<div class="btn-group">

<button
type="submit"
class="update-btn"
>

🚀 Update Profile

</button>

<a
href="{{ route('profiles.index') }}"
class="back-btn"
>

← Back Dashboard

</a>

</div>

</form>

</div>

<script>

function previewImages(event)
{
    let preview =
    document.getElementById(
        'imagePreview'
    );

    preview.innerHTML = '';

    let files =
    event.target.files;

    for(let i=0;i<files.length;i++)
    {
        let reader =
        new FileReader();

        reader.onload =
        function(e)
        {
            let img =
            document.createElement(
                'img'
            );

            img.src =
            e.target.result;

            preview.appendChild(img);
        }

        reader.readAsDataURL(
            files[i]
        );
    }
}

function previewVideos(event)
{
    let preview =
    document.getElementById(
        'videoPreview'
    );

    preview.innerHTML = '';

    let files =
    event.target.files;

    for(let i=0;i<files.length;i++)
    {
        let reader =
        new FileReader();

        reader.onload =
        function(e)
        {
            let video =
            document.createElement(
                'video'
            );

            video.src =
            e.target.result;

            video.controls = true;

            preview.appendChild(video);
        }

        reader.readAsDataURL(
            files[i]
        );
    }
}

</script>

</body>
</html>