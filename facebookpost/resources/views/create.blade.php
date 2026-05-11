<!DOCTYPE html>
<html>
<head>
    <title>Create Profile</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:Arial, sans-serif;
        }

        body{
            background:linear-gradient(135deg,#f1f5ff,#eef7ff);
            min-height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
            padding:20px;
            overflow-x:hidden;
            position:relative;
        }

        /* Background Design */

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
            width:260px;
            height:260px;
            background:#bfdbfe;
            bottom:-80px;
            right:-80px;
            opacity:0.4;
        }

        /* Main Container */

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
            animation:fadeIn 0.7s ease;
        }

        @keyframes fadeIn{
            from{
                opacity:0;
                transform:translateY(30px);
            }
            to{
                opacity:1;
                transform:translateY(0);
            }
        }

        .profile-icon{
            width:100px;
            height:100px;
            margin:auto;
            border-radius:50%;
            background:linear-gradient(135deg,#6366f1,#3b82f6);
            display:flex;
            justify-content:center;
            align-items:center;
            color:white;
            font-size:42px;
            box-shadow:0 8px 20px rgba(59,130,246,0.3);
            margin-bottom:20px;
        }

        h2{
            text-align:center;
            margin-bottom:30px;
            color:#1e293b;
            font-size:34px;
        }

        /* Form Grid */

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
            font-size:15px;
        }

        input,
        textarea{
            width:100%;
            padding:15px;
            border-radius:12px;
            border:1px solid #dbeafe;
            outline:none;
            background:#f8fafc;
            transition:0.3s;
            font-size:15px;
        }

        input:focus,
        textarea:focus{
            border-color:#6366f1;
            background:white;
            box-shadow:0 0 10px rgba(99,102,241,0.2);
            transform:scale(1.01);
        }

        textarea{
            resize:none;
            height:120px;
        }

        /* File Upload */

        .file-box{
            border:2px dashed #93c5fd;
            border-radius:15px;
            padding:30px;
            text-align:center;
            background:#eff6ff;
            transition:0.3s;
        }

        .file-box:hover{
            background:#dbeafe;
            transform:scale(1.01);
        }

        input[type="file"]{
            border:none;
            background:none;
            margin-top:10px;
            cursor:pointer;
        }

        /* Button */

        button{
            width:100%;
            padding:16px;
            border:none;
            border-radius:14px;
            background:linear-gradient(135deg,#6366f1,#3b82f6);
            color:white;
            font-size:17px;
            font-weight:bold;
            cursor:pointer;
            transition:0.3s;
            margin-top:10px;
        }

        button:hover{
            transform:translateY(-2px);
            box-shadow:0 10px 20px rgba(59,130,246,0.3);
        }

        .back-btn{
            display:block;
            text-align:center;
            margin-top:20px;
            text-decoration:none;
            color:#4f46e5;
            font-weight:bold;
            transition:0.3s;
        }

        .back-btn:hover{
            color:#1d4ed8;
        }

        .small-text{
            text-align:center;
            margin-top:15px;
            color:#64748b;
            font-size:14px;
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

            h2{
                font-size:28px;
            }

            .profile-icon{
                width:80px;
                height:80px;
                font-size:34px;
            }

        }

    </style>

</head>
<body>

<div class="bg1"></div>
<div class="bg2"></div>

<div class="container">

    <div class="profile-icon">
        👤
    </div>

    <h2>Create Profile</h2>

    <form action="{{ route('profiles.store') }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf

        <div class="form-row">

            <div class="input-group">

                <label>Full Name</label>

                <input type="text"
                       name="name"
                       placeholder="Enter your full name">

            </div>

            <div class="input-group">

                <label>Email Address</label>

                <input type="email"
                       name="email"
                       placeholder="Enter your email">

            </div>

        </div>

        <div class="input-group">

            <label>Description</label>

            <textarea name="description"
                      placeholder="Write something about yourself"></textarea>

        </div>

        <div class="input-group">

            <label>Upload Profile Images</label>

            <div class="file-box">

                📸 Choose Profile Photo

                <br><br>

                <input type="file" name="images[]" multiple>
            </div>

        </div>

        <div class="input-group">

            <label>Upload Profile Video</label>

            <div class="file-box">

                🎥 Choose Profile Video

                <br><br>

            <input type="file" name="videos[]" multiple>
            
            </div>

        </div>

        <button type="submit">
             Save Profile
        </button>

        <a href="{{ route('profiles.index') }}"
           class="back-btn">

            ← Back to Profile List

        </a>

    </form>

</div>

</body>
</html>