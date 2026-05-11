<!DOCTYPE html>
<html>
<head>

    <title>Edit Profile</title>

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:Arial,sans-serif;
        }

        body{
            background:linear-gradient(135deg,#f8fbff,#eef4ff);
            min-height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
            padding:20px;
            overflow-x:hidden;
            position:relative;
        }

        .bg1,
        .bg2{
            position:absolute;
            border-radius:50%;
            z-index:0;
        }

        .bg1{
            width:320px;
            height:320px;
            background:#c7d2fe;
            top:-100px;
            left:-100px;
            opacity:0.4;
        }

        .bg2{
            width:250px;
            height:250px;
            background:#bfdbfe;
            bottom:-80px;
            right:-80px;
            opacity:0.4;
        }

        .container{
            width:100%;
            max-width:750px;
            background:rgba(255,255,255,0.95);
            backdrop-filter:blur(10px);
            padding:45px;
            border-radius:25px;
            box-shadow:0 10px 35px rgba(0,0,0,0.08);
            position:relative;
            z-index:1;
        }

        h2{
            text-align:center;
            margin-bottom:30px;
            color:#1e293b;
            font-size:34px;
        }

        .profile-preview{
            text-align:center;
            margin-bottom:25px;
        }

        .profile-preview img,
        .profile-preview video{
            width:130px;
            height:130px;
            border-radius:50%;
            object-fit:cover;
            border:5px solid #dbeafe;
            box-shadow:0 5px 20px rgba(0,0,0,0.08);
        }

        .form-row{
            display:flex;
            gap:20px;
        }

        .input-group{
            width:100%;
            margin-bottom:22px;
        }

        label{
            display:block;
            margin-bottom:8px;
            color:#475569;
            font-weight:bold;
        }

        input,
        textarea{
            width:100%;
            padding:15px;
            border-radius:12px;
            border:1px solid #dbeafe;
            background:#f8fafc;
            outline:none;
            transition:0.3s;
            font-size:15px;
        }

        input:focus,
        textarea:focus{
            border-color:#6366f1;
            background:white;
            box-shadow:0 0 10px rgba(99,102,241,0.2);
        }

        textarea{
            resize:none;
            height:120px;
        }

        .file-box{
            border:2px dashed #93c5fd;
            border-radius:15px;
            padding:25px;
            text-align:center;
            background:#eff6ff;
        }

        input[type="file"]{
            border:none;
            background:none;
            margin-top:10px;
        }

        .btn-group{
            display:flex;
            gap:15px;
            margin-top:10px;
        }

        button{
            flex:1;
            padding:15px;
            border:none;
            border-radius:14px;
            background:linear-gradient(135deg,#22c55e,#16a34a);
            color:white;
            font-size:16px;
            font-weight:bold;
            cursor:pointer;
        }

        .back-btn{
            flex:1;
            text-align:center;
            padding:15px;
            border-radius:14px;
            background:#6366f1;
            color:white;
            text-decoration:none;
            font-weight:bold;
        }

        @media(max-width:768px){

            .container{
                padding:30px;
            }

            .form-row{
                flex-direction:column;
                gap:0;
            }

            .btn-group{
                flex-direction:column;
            }

            h2{
                font-size:28px;
            }
        }

    </style>

</head>

<body>

<div class="bg1"></div>
<div class="bg2"></div>

<div class="container">

    <h2>✏ Edit Profile</h2>

    <!-- PREVIEW -->

    <div class="profile-preview">

        @if($profile->image)

            <img
                src="{{ asset('uploads/profiles/'.$profile->image) }}"
            >

        @elseif($profile->video)

            <video controls>

                <source
                    src="{{ asset('uploads/videos/'.$profile->video) }}"
                    type="video/mp4">

            </video>

        @endif

    </div>

    <!-- FORM -->

    <form
        action="{{ route('profiles.update',$profile->id) }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf
        @method('PUT')

        <div class="form-row">

            <div class="input-group">

                <label>Full Name</label>

                <input
                    type="text"
                    name="name"
                    value="{{ $profile->name }}"
                >

            </div>

            <div class="input-group">

                <label>Email Address</label>

                <input
                    type="email"
                    name="email"
                    value="{{ $profile->email }}"
                >

            </div>

        </div>

        <div class="input-group">

            <label>Description</label>

            <textarea
                name="description"
            >{{ $profile->description }}</textarea>

        </div>

        <!-- IMAGE -->

        <div class="input-group">

            <label>Change Images</label>

            <div class="file-box">

                📸 Upload Images

                <br><br>

                <input
                    type="file"
                    name="images[]"
                    multiple
                >

            </div>

        </div>

        <!-- VIDEO -->

        <div class="input-group">

            <label>Change Videos</label>

            <div class="file-box">

                🎥 Upload Videos

                <br><br>

                <input
                    type="file"
                    name="videos[]"
                    multiple
                >

            </div>

        </div>

        <!-- BUTTONS -->

        <div class="btn-group">

            <button type="submit">

                Update Profile

            </button>

            <a
                href="{{ route('profiles.index') }}"
                class="back-btn"
            >

                ← Back

            </a>

        </div>

    </form>

</div>

</body>
</html>