<!DOCTYPE html>
<html>
<head>
    <title>View Profile</title>

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
            overflow-x:hidden;
            position:relative;
        }

        /* Background */

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

        /* Card */

        .profile-card{
            width:100%;
            max-width:850px;
            background:white;
            border-radius:25px;
            overflow:hidden;
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

        /* Top Banner */

        .top-section{
            background:linear-gradient(135deg,#6366f1,#3b82f6);
            height:200px;
            position:relative;
        }

        .profile-image{
            position:absolute;
            bottom:-65px;
            left:50%;
            transform:translateX(-50%);
        }

        .profile-image img{
            width:140px;
            height:140px;
            border-radius:50%;
            object-fit:cover;
            border:6px solid white;
            box-shadow:0 5px 20px rgba(0,0,0,0.15);
            transition:0.3s;
        }

        .profile-image img:hover{
            transform:scale(1.05);
        }

        /* Content */

        .content{
            padding:90px 40px 40px;
            text-align:center;
        }

        h2{
            font-size:36px;
            color:#1e293b;
            margin-bottom:10px;
        }

        .email{
            color:#6366f1;
            font-size:17px;
            margin-bottom:20px;
        }

        .badge{
            display:inline-block;
            background:#dcfce7;
            color:#166534;
            padding:8px 16px;
            border-radius:30px;
            font-size:14px;
            font-weight:bold;
            margin-bottom:25px;
        }

        /* Description */

        .description-box{
            background:#f8fafc;
            padding:25px;
            border-radius:18px;
            line-height:1.8;
            color:#475569;
            font-size:16px;
            box-shadow:0 5px 15px rgba(0,0,0,0.03);
        }

        /* Info Grid */

        .info-grid{
            margin-top:30px;
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
            gap:20px;
        }

        .info-box{
            background:#f8fafc;
            padding:20px;
            border-radius:15px;
            box-shadow:0 4px 12px rgba(0,0,0,0.03);
            transition:0.3s;
        }

        .info-box:hover{
            transform:translateY(-3px);
        }

        .info-box h4{
            color:#64748b;
            margin-bottom:10px;
            font-size:14px;
        }

        .info-box p{
            color:#1e293b;
            font-weight:bold;
            font-size:16px;
        }

        /* Buttons */

        .btn-group{
            margin-top:35px;
            display:flex;
            justify-content:center;
            gap:15px;
            flex-wrap:wrap;
        }

        .edit-btn,
        .back-btn{
            padding:14px 24px;
            border-radius:12px;
            text-decoration:none;
            color:white;
            font-weight:bold;
            transition:0.3s;
        }

        .edit-btn{
            background:#0ea5e9;
        }

        .edit-btn:hover{
            background:#0284c7;
            transform:translateY(-2px);
        }

        .back-btn{
            background:#6366f1;
        }

        .back-btn:hover{
            background:#4f46e5;
            transform:translateY(-2px);
        }

        /* Responsive */

        @media(max-width:768px){

            .content{
                padding:90px 20px 30px;
            }

            h2{
                font-size:28px;
            }

            .description-box{
                font-size:15px;
            }

            .profile-image img{
                width:120px;
                height:120px;
            }

        }

    </style>

</head>
<body>

<div class="bg1"></div>
<div class="bg2"></div>

<div class="profile-card">

    <!-- Top Banner -->

    <div class="top-section">

        <div class="profile-image">

            <img src="{{ asset('profile_images/'.$profile->image) }}">

        </div>

    </div>

    <!-- Content -->

    <div class="content">

        <h2>{{ $profile->name }}</h2>

        <div class="email">

            📧 {{ $profile->email }}

        </div>

        <span class="badge">

            ✅ Active Profile

        </span>

        <!-- Description -->

        <div class="description-box">

            {{ $profile->description }}

        </div>

        <!-- Extra Information -->

        <div class="info-grid">

            <div class="info-box">

                <h4>Profile ID</h4>

                <p>#{{ $profile->id }}</p>

            </div>

            <div class="info-box">

                <h4>Created Date</h4>

                <p>{{ $profile->created_at->format('d M Y') }}</p>

            </div>

            <div class="info-box">

                <h4>Status</h4>

                <p>Active</p>

            </div>

        </div>

        <!-- Buttons -->

        <div class="btn-group">

            <a href="{{ route('profiles.edit',$profile->id) }}"
               class="edit-btn">

               ✏ Edit Profile

            </a>

            <a href="{{ route('profiles.index') }}"
               class="back-btn">

               ← Back Dashboard

            </a>

        </div>

    </div>

</div>

</body>
</html>