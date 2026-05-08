<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:Arial, sans-serif;
        }

        body{
            background:linear-gradient(135deg,#f8fbff,#eef4ff);
            min-height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
            padding:20px;
            position:relative;
            overflow-x:hidden;
        }

        /* Background Circles */

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

        /* Container */

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
            animation:fadeIn 0.6s ease;
        }

        @keyframes fadeIn{
            from{
                opacity:0;
                transform:translateY(20px);
            }
            to{
                opacity:1;
                transform:translateY(0);
            }
        }

        /* Heading */

        h2{
            text-align:center;
            color:#1e293b;
            margin-bottom:30px;
            font-size:34px;
        }

        /* Profile Image */

        .profile-preview{
            text-align:center;
            margin-bottom:25px;
        }

        .profile-preview img{
            width:120px;
            height:120px;
            border-radius:50%;
            object-fit:cover;
            border:5px solid #dbeafe;
            box-shadow:0 5px 20px rgba(0,0,0,0.08);
            transition:0.3s;
        }

        .profile-preview img:hover{
            transform:scale(1.05);
        }

        /* Form */

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

        /* File Upload */

        .file-box{
            border:2px dashed #93c5fd;
            border-radius:15px;
            padding:25px;
            text-align:center;
            background:#eff6ff;
            transition:0.3s;
        }

        .file-box:hover{
            background:#dbeafe;
        }

        input[type="file"]{
            border:none;
            background:none;
            margin-top:10px;
            cursor:pointer;
        }

        /* Buttons */

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
            transition:0.3s;
        }

        button:hover{
            transform:translateY(-2px);
            box-shadow:0 10px 20px rgba(34,197,94,0.25);
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
            transition:0.3s;
        }

        .back-btn:hover{
            background:#4f46e5;
            transform:translateY(-2px);
        }

        /* Responsive */

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

    <!-- Profile Preview -->

    <div class="profile-preview">

        <img src="{{ asset('profile_images/'.$profile->image) }}">

    </div>

    <!-- Form -->

    <form action="{{ route('profiles.update',$profile->id) }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="form-row">

            <div class="input-group">

                <label>Full Name</label>

                <input type="text"
                       name="name"
                       value="{{ $profile->name }}">

            </div>

            <div class="input-group">

                <label>Email Address</label>

                <input type="email"
                       name="email"
                       value="{{ $profile->email }}">

            </div>

        </div>

        <div class="input-group">

            <label>Description</label>

            <textarea name="description">{{ $profile->description }}</textarea>

        </div>

        <div class="input-group">

            <label>Change Profile Image</label>

            <div class="file-box">

                📸 Upload New Profile Photo

                <br><br>

                <input type="file" name="image">

            </div>

        </div>

        <div class="btn-group">

            <button type="submit">

                 Update Profile

            </button>

            <a href="{{ route('profiles.index') }}"
               class="back-btn">

               ← Back

            </a>

        </div>

    </form>

</div>

</body>
</html>