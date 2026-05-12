<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>
    Create Post
</title>

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial,sans-serif;
}

body{
    background:
    linear-gradient(
        135deg,
        #0f172a,
        #1e3a8a,
        #2563eb
    );

    min-height:100vh;
    padding:40px;
}

.container{
    max-width:1400px;
    margin:auto;
}

.main-card{
    background:white;
    border-radius:35px;
    overflow:hidden;
    box-shadow:
    0 20px 60px rgba(0,0,0,0.25);
}

.top-header{
    background:
    linear-gradient(
        135deg,
        #2563eb,
        #4f46e5,
        #7c3aed
    );

    padding:45px;
    color:white;
}

.top-header h1{
    font-size:42px;
    margin-bottom:10px;
}

.top-header p{
    opacity:0.9;
    font-size:18px;
}

.back-btn{
    display:inline-block;
    margin-top:25px;
    background:white;
    color:#2563eb;
    text-decoration:none;
    padding:14px 22px;
    border-radius:16px;
    font-weight:bold;
    transition:0.3s;
}

.back-btn:hover{
    transform:translateY(-3px);
}

.content{
    padding:35px;
}

.grid{
    display:grid;
    grid-template-columns:2fr 1fr;
    gap:30px;
}

.card{
    background:#f8fafc;
    border-radius:30px;
    padding:30px;
    box-shadow:
    0 10px 30px rgba(0,0,0,0.05);
}

.section-title{
    font-size:30px;
    font-weight:bold;
    color:#0f172a;
    margin-bottom:25px;
}

.row{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:20px;
}

.input-group{
    margin-bottom:22px;
}

.input-group label{
    display:block;
    margin-bottom:10px;
    font-weight:bold;
    color:#334155;
}

.input-group input,
.input-group textarea,
.input-group select{
    width:100%;
    padding:18px;
    border:none;
    border-radius:18px;
    background:white;
    border:2px solid #e2e8f0;
    font-size:16px;
    transition:0.3s;
}

.input-group input:focus,
.input-group textarea:focus,
.input-group select:focus{
    outline:none;
    border-color:#2563eb;
    box-shadow:
    0 0 15px rgba(37,99,235,0.2);
}

textarea{
    resize:none;
    min-height:180px;
}

.file-box{
    border:3px dashed #93c5fd;
    border-radius:25px;
    background:#eff6ff;
    padding:35px;
    text-align:center;
    transition:0.3s;
}

.file-box:hover{
    background:#dbeafe;
}

.file-box input{
    margin-top:15px;
}

.preview-gallery{
    display:flex;
    flex-wrap:wrap;
    gap:12px;
    margin-top:18px;
}

.preview-gallery img{
    width:120px;
    height:120px;
    object-fit:cover;
    border-radius:18px;
}

.preview-gallery video{
    width:200px;
    border-radius:18px;
}

.toolbar{
    display:flex;
    gap:12px;
    margin-bottom:20px;
    flex-wrap:wrap;
}

.tool-btn{
    border:none;
    background:#2563eb;
    color:white;
    padding:12px 18px;
    border-radius:14px;
    cursor:pointer;
    font-weight:bold;
    transition:0.3s;
}

.tool-btn:hover{
    transform:scale(1.05);
}

.emoji-box{
    display:flex;
    gap:12px;
    flex-wrap:wrap;
    margin-bottom:25px;
}

.emoji{
    width:55px;
    height:55px;
    background:white;
    border-radius:18px;
    display:flex;
    justify-content:center;
    align-items:center;
    font-size:28px;
    cursor:pointer;
    transition:0.3s;
    box-shadow:
    0 5px 15px rgba(0,0,0,0.08);
}

.emoji:hover{
    transform:scale(1.1);
}

.socials{
    display:flex;
    gap:20px;
    margin-top:20px;
}

.social-btn{
    flex:1;
    padding:22px;
    border-radius:25px;
    text-align:center;
    color:white;
    font-size:20px;
    font-weight:bold;
    cursor:pointer;
    position:relative;
    transition:0.3s;
}

.social-btn:hover{
    transform:translateY(-4px);
}

.facebook{
    background:
    linear-gradient(
        135deg,
        #1877f2,
        #0d5bd7
    );
}

.instagram{
    background:
    linear-gradient(
        135deg,
        #f58529,
        #dd2a7b,
        #8134af,
        #515bd4
    );
}

.social-btn input{
    display:none;
}

.social-btn:has(input:checked){
    transform:scale(1.05);
    box-shadow:
    0 0 25px rgba(37,99,235,0.4);
}

.social-btn:has(input:checked)::after{
    content:"✔";
    position:absolute;
    top:10px;
    right:15px;
    width:30px;
    height:30px;
    background:white;
    color:black;
    border-radius:50%;
    display:flex;
    justify-content:center;
    align-items:center;
}

.publish-btn{
    width:100%;
    border:none;
    padding:20px;
    border-radius:22px;
    background:
    linear-gradient(
        135deg,
        #2563eb,
        #4f46e5
    );

    color:white;
    font-size:20px;
    font-weight:bold;
    cursor:pointer;
    margin-top:25px;
    transition:0.3s;
}

.publish-btn:hover{
    transform:translateY(-4px);
}

.archive-btn{
    display:block;
    margin-top:18px;
    text-align:center;
    background:#0f172a;
    color:white;
    text-decoration:none;
    padding:18px;
    border-radius:20px;
    font-weight:bold;
}

.preview{
    background:white;
    border-radius:25px;
    padding:25px;
    box-shadow:
    0 10px 30px rgba(0,0,0,0.05);
}

.preview-top{
    display:flex;
    align-items:center;
    gap:15px;
    margin-bottom:20px;
}

.profile{
    width:70px;
    height:70px;
    border-radius:50%;
    background:#2563eb;
    color:white;
    display:flex;
    justify-content:center;
    align-items:center;
    font-size:28px;
}

.preview-text{
    white-space:pre-wrap;
    line-height:1.8;
    color:#334155;
}

.preview-actions{
    display:flex;
    justify-content:space-between;
    margin-top:25px;
    color:#64748b;
}

.alert{
    padding:18px;
    border-radius:18px;
    margin-bottom:20px;
    font-weight:bold;
}

.success{
    background:#dcfce7;
    color:#166534;
}

.error{
    background:#fee2e2;
    color:#991b1b;
}

@media(max-width:900px){

    .grid{
        grid-template-columns:1fr;
    }

    .row{
        grid-template-columns:1fr;
    }

    .socials{
        flex-direction:column;
    }

    body{
        padding:20px;
    }

}

</style>

</head>

<body>

<div class="container">

<div class="main-card">

<div class="top-header">

<h1>
    🚀 Social Media Dashboard
</h1>

<p>
    Facebook & Instagram Auto Post Manager
</p>

<a href="{{ route('profiles.index') }}"
   class="back-btn">

    ← Back To Dashboard

</a>

</div>

<div class="content">

@if(session('success'))

<div class="alert success">
    {{ session('success') }}
</div>

@endif

@if(session('error'))

<div class="alert error">
    {{ session('error') }}
</div>

@endif

@if($errors->any())

<div class="alert error">

    @foreach($errors->all() as $error)

        <div>{{ $error }}</div>

    @endforeach

</div>

@endif

<div class="grid">

<!-- LEFT -->

<div class="card">

<div class="section-title">
    ✍ Create New Post
</div>

<form action="{{ route('profiles.store') }}"
      method="POST"
      enctype="multipart/form-data">

@csrf

<div class="row">

<div class="input-group">

<label>
    Full Name
</label>

<input type="text"
       name="name"
       placeholder="Enter Name"
       required>

</div>

<div class="input-group">

<label>
    Email Address
</label>

<input type="email"
       name="email"
       placeholder="Enter Email"
       required>

</div>

</div>

<div class="input-group">

<label>
    Description
</label>

<textarea id="caption"
          name="description"
          placeholder="Write amazing post..."
          onkeyup="livePreview()"
          required></textarea>

</div>

<div class="toolbar">

<button type="button"
        class="tool-btn"
        onclick="clearText()">

🗑 Clear

</button>

</div>

<div class="emoji-box">

<div class="emoji" onclick="addEmoji('🔥')">🔥</div>
<div class="emoji" onclick="addEmoji('😍')">😍</div>
<div class="emoji" onclick="addEmoji('❤️')">❤️</div>
<div class="emoji" onclick="addEmoji('🎉')">🎉</div>
<div class="emoji" onclick="addEmoji('🚀')">🚀</div>
<div class="emoji" onclick="addEmoji('😎')">😎</div>
<div class="emoji" onclick="addEmoji('😂')">😂</div>
<div class="emoji" onclick="addEmoji('💯')">💯</div>

</div>

<div class="row">

<div class="input-group">

<label>
    Upload Images 📸
</label>

<div class="file-box">

<h3>
    📷 Select Images
</h3>

<br>

<input type="file"
       id="imageInput"
       name="images[]"
       multiple
       accept="image/*"
       onchange="previewImages(event)">

</div>

<div id="imagePreview"
     class="preview-gallery"></div>

</div>

<div class="input-group">

<label>
    Upload Videos 🎥
</label>

<div class="file-box">

<h3>
    🎬 Select Videos
</h3>

<br>

<input type="file"
       id="videoInput"
       name="videos[]"
       multiple
       accept="video/*"
       onchange="previewVideos(event)">

</div>

<div id="videoPreview"
     class="preview-gallery"></div>

</div>

</div>

<div class="row">

<div class="input-group">

<label>
    Tag People
</label>

<input type="text"
       name="tags"
       placeholder="@john">

</div>

<div class="input-group">

<label>
    Hashtags
</label>

<input type="text"
       name="hashtags"
       placeholder="#viral #beauty">

</div>

</div>

<div class="row">

<div class="input-group">

<label>
    Post Status
</label>

<select name="status">

<option value="publish">
    🚀 Publish
</option>

<option value="draft">
    📝 Draft
</option>

<option value="archive">
    📦 Archive
</option>

</select>

</div>

<div class="input-group">

<label>
    Schedule Time
</label>

<input type="datetime-local"
       name="schedule_time">

</div>

</div>

<div class="socials">

<label class="social-btn facebook">

<input type="checkbox"
       name="platforms[]"
       value="facebook">

📘 Facebook

</label>

<label class="social-btn instagram">

<input type="checkbox"
       name="platforms[]"
       value="instagram">

📸 Instagram

</label>

</div>

<button class="publish-btn">

🚀 Publish Post

</button>

<a href="{{ route('profiles.archive') }}"
   class="archive-btn">

📦 View Archived Posts

</a>

</form>

</div>

<!-- RIGHT -->

<div class="card">

<div class="section-title">
    📘 Live Preview
</div>

<div class="preview">

<div class="preview-top">

<div class="profile">
    👤
</div>

<div>

<h3>
    Skn Studio
</h3>

<small>
    Just now · 🌍 Public
</small>

</div>

</div>

<div id="previewText"
     class="preview-text">

Your post preview...

</div>

<div class="preview-actions">

<div>👍 Like</div>
<div>💬 Comment</div>
<div>↗ Share</div>

</div>

</div>

</div>

</div>

</div>

</div>

</div>

<script>

function livePreview()
{
    let text =
        document.getElementById(
            'caption'
        ).value;

    document.getElementById(
        'previewText'
    ).innerHTML = text;
}

function addEmoji(emoji)
{
    let caption =
        document.getElementById(
            'caption'
        );

    caption.value += emoji;

    livePreview();
}

function clearText()
{
    document.getElementById(
        'caption'
    ).value = '';

    document.getElementById(
        'previewText'
    ).innerHTML =
        'Your post preview...';
}

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