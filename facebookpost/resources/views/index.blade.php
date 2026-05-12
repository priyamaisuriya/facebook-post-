<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        🚀 Social Media Dashboard
    </title>

    <!-- DataTable -->

    <link rel="stylesheet"
          href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <!-- Font Awesome -->

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
                #eef2ff,
                #dbeafe,
                #f8fafc
            );

            min-height:100vh;

            padding:35px;

            transition:0.4s;
        }

        body.dark{

            background:
            linear-gradient(
                135deg,
                #020617,
                #0f172a,
                #1e293b
            );

            color:white;
        }

        .container{
            max-width:1500px;
            margin:auto;
        }

        .header{

            display:flex;

            justify-content:space-between;

            align-items:center;

            margin-bottom:30px;

            flex-wrap:wrap;

            gap:15px;
        }

        .title-box h1{

            font-size:42px;

            color:#1e293b;

            margin-bottom:10px;
        }

        body.dark .title-box h1{
            color:white;
        }

        .title-box p{

            color:#64748b;

            font-size:18px;
        }

        body.dark .title-box p{
            color:#cbd5e1;
        }

        .top-actions{

            display:flex;

            gap:15px;

            flex-wrap:wrap;
        }

        .top-btn{

            padding:15px 24px;

            border-radius:16px;

            text-decoration:none;

            color:white;

            font-weight:bold;

            transition:0.3s;

            border:none;

            cursor:pointer;
        }

        .create-btn{

            background:
            linear-gradient(
                135deg,
                #2563eb,
                #4f46e5
            );
        }

        .archive-btn{

            background:
            linear-gradient(
                135deg,
                #0f172a,
                #1e293b
            );
        }

        .theme-btn{

            background:
            linear-gradient(
                135deg,
                #f59e0b,
                #ea580c
            );
        }

        .top-btn:hover{

            transform:
            translateY(-4px);
        }

        .success{

            background:#dcfce7;

            color:#166534;

            padding:18px;

            border-radius:18px;

            margin-bottom:25px;

            border-left:6px solid #22c55e;

            font-weight:bold;
        }

        .stats-grid{

            display:grid;

            grid-template-columns:
            repeat(4,1fr);

            gap:20px;

            margin-bottom:30px;
        }

        .stat-card{

            background:white;

            padding:25px;

            border-radius:28px;

            box-shadow:
            0 10px 30px
            rgba(0,0,0,0.07);

            transition:0.3s;
        }

        body.dark .stat-card{
            background:#1e293b;
        }

        .stat-card:hover{

            transform:
            translateY(-5px);
        }

        .stat-icon{

            width:65px;

            height:65px;

            border-radius:20px;

            display:flex;

            align-items:center;

            justify-content:center;

            font-size:28px;

            color:white;

            margin-bottom:18px;
        }

        .bg1{
            background:
            linear-gradient(
                135deg,
                #2563eb,
                #4f46e5
            );
        }

        .bg2{
            background:
            linear-gradient(
                135deg,
                #22c55e,
                #16a34a
            );
        }

        .bg3{
            background:
            linear-gradient(
                135deg,
                #ec4899,
                #db2777
            );
        }

        .bg4{
            background:
            linear-gradient(
                135deg,
                #f59e0b,
                #ea580c
            );
        }

        .stat-card h2{

            font-size:35px;

            color:#0f172a;

            margin-bottom:8px;
        }

        body.dark .stat-card h2{
            color:white;
        }

        .stat-card p{

            color:#64748b;
        }

        body.dark .stat-card p{
            color:#cbd5e1;
        }

        .table-card{

            background:white;

            border-radius:35px;

            padding:30px;

            box-shadow:
            0 15px 40px
            rgba(0,0,0,0.08);
        }

        body.dark .table-card{
            background:#1e293b;
        }

        .table-header{

            display:flex;

            justify-content:space-between;

            align-items:center;

            margin-bottom:25px;
        }

        .table-header h2{

            color:#1e293b;

            font-size:30px;
        }

        body.dark .table-header h2{
            color:white;
        }

        table{
            width:100% !important;
        }

        table thead th{

            background:#eef2ff;

            color:#3730a3;

            padding:18px !important;
        }

        body.dark table thead th{
            background:#334155;
            color:white;
        }

        table tbody td{

            padding:22px !important;

            vertical-align:middle;
        }

        body.dark table tbody td{
            color:white;
        }

        .media-box{

            width:110px;

            height:110px;

            border-radius:22px;

            overflow:hidden;

            margin:auto;

            border:4px solid #dbeafe;

            background:#f8fafc;
        }

        .media-box img,
        .media-box video{

            width:100%;

            height:100%;

            object-fit:cover;
        }

        .name-box h3{

            color:#0f172a;

            margin-bottom:6px;
        }

        body.dark .name-box h3{
            color:white;
        }

        .name-box p{

            color:#64748b;

            font-size:14px;
        }

        body.dark .name-box p{
            color:#cbd5e1;
        }

        .desc{

            max-width:260px;

            line-height:1.7;

            color:#475569;
        }

        body.dark .desc{
            color:#e2e8f0;
        }

        .badge{

            padding:8px 16px;

            border-radius:30px;

            font-size:13px;

            font-weight:bold;

            display:inline-block;
        }

        .publish{
            background:#dcfce7;
            color:#166534;
        }

        .draft{
            background:#fef9c3;
            color:#854d0e;
        }

        .archive{
            background:#e2e8f0;
            color:#334155;
        }

        .social-icons{

            display:flex;

            gap:10px;

            justify-content:center;
        }

        .social-icons span{

            width:40px;

            height:40px;

            border-radius:12px;

            display:flex;

            justify-content:center;

            align-items:center;

            color:white;

            font-size:18px;
        }

        .fb{
            background:#1877f2;
        }

        .insta{
            background:
            linear-gradient(
                135deg,
                #f58529,
                #dd2a7b,
                #8134af
            );
        }

        .analytics{

            display:grid;

            grid-template-columns:
            repeat(2,1fr);

            gap:10px;
        }

        .mini-card{

            background:#f8fafc;

            border-radius:18px;

            padding:12px;

            text-align:center;
        }

        body.dark .mini-card{
            background:#334155;
        }

        .mini-card h4{

            color:#64748b;

            font-size:13px;

            margin-bottom:6px;
        }

        body.dark .mini-card h4{
            color:#cbd5e1;
        }

        .mini-card p{

            color:#2563eb;

            font-size:20px;

            font-weight:bold;
        }

        .action-box{

            display:flex;

            gap:10px;

            justify-content:center;

            flex-wrap:wrap;
        }

        .action-btn{

            width:45px;

            height:45px;

            border:none;

            border-radius:14px;

            color:white;

            font-size:17px;

            cursor:pointer;

            transition:0.3s;

            display:flex;

            justify-content:center;

            align-items:center;

            text-decoration:none;
        }

        .view-btn{
            background:#22c55e;
        }

        .edit-btn{
            background:#0ea5e9;
        }

        .delete-btn{
            background:#ef4444;
        }

        .archive-post-btn{
            background:#0f172a;
        }

        .action-btn:hover{

            transform:
            translateY(-3px)
            scale(1.05);
        }

        @media(max-width:1100px){

            .stats-grid{

                grid-template-columns:
                repeat(2,1fr);
            }

        }

        @media(max-width:768px){

            body{
                padding:18px;
            }

            .stats-grid{
                grid-template-columns:1fr;
            }

            .header{
                flex-direction:column;
                align-items:flex-start;
            }

            .title-box h1{
                font-size:30px;
            }

        }

    </style>

</head>

<body>

<div class="container">

    <!-- HEADER -->

    <div class="header">

        <div class="title-box">

            <h1>
                🚀 Social Media Dashboard
            </h1>

            <p>
                Facebook Auto Post • Media Manager • Analytics
            </p>

        </div>

        <div class="top-actions">

            <button onclick="toggleTheme()"
                    class="top-btn theme-btn">

                🌙 Day / Night

            </button>

            <a href="{{ route('profiles.create') }}"
               class="top-btn create-btn">

               ➕ Create Post

            </a>

            <a href="{{ route('profiles.archive') }}"
               class="top-btn archive-btn">

               📦 Archive

            </a>

        </div>

    </div>

    <!-- SUCCESS -->

    @if(session('success'))

        <div class="success">

            ✅ {{ session('success') }}

        </div>

    @endif

    <!-- STATS -->

    <div class="stats-grid">

        <div class="stat-card">

            <div class="stat-icon bg1">👤</div>

            <h2>{{ $profiles->count() }}</h2>

            <p>Total Posts</p>

        </div>

        <div class="stat-card">

            <div class="stat-icon bg2">👍</div>

            <h2>{{ $profiles->sum('facebook_likes') }}</h2>

            <p>Facebook Likes</p>

        </div>

        <div class="stat-card">

            <div class="stat-icon bg3">💬</div>

            <h2>{{ $profiles->sum('facebook_comments') }}</h2>

            <p>Comments</p>

        </div>

        <div class="stat-card">

            <div class="stat-icon bg4">👥</div>

            <h2>{{ $profiles->sum('facebook_followers') }}</h2>

            <p>Followers</p>

        </div>

    </div>

    <!-- TABLE -->

    <div class="table-card">

        <div class="table-header">

            <h2>
                📘 All Social Posts
            </h2>

        </div>

        <table id="profileTable">

            <thead>

            <tr>

                <th>ID</th>
                <th>Media</th>
                <th>User</th>
                <th>Description</th>
                <th>Social</th>
                <th>Status</th>
                <th>Actions</th>

            </tr>

            </thead>

            <tbody>

            @foreach($profiles as $profile)

            <tr>

                <td>
                    <strong>#{{ $profile->id }}</strong>
                </td>

                <!-- MEDIA -->

                <td>

                    <div class="media-box">

                        @php

                            $images = [];

                            $videos = [];

                            if(!empty($profile->images))
                            {
                                $decodedImages = json_decode($profile->images, true);

                                if(is_array($decodedImages))
                                {
                                    $images = $decodedImages;
                                }
                            }

                            if(!empty($profile->videos))
                            {
                                $decodedVideos = json_decode($profile->videos, true);

                                if(is_array($decodedVideos))
                                {
                                    $videos = $decodedVideos;
                                }
                            }

                        @endphp

                        @if(is_array($images) && count($images) > 0)

                            <img src="{{ asset('uploads/profiles/'.$images[0]) }}">

                        @elseif(is_array($videos) && count($videos) > 0)

                            <video controls>

                                <source src="{{ asset('uploads/videos/'.$videos[0]) }}"
                                        type="video/mp4">

                            </video>

                        @else

                            <img src="https://via.placeholder.com/100">

                        @endif

                    </div>

                </td>

                <!-- USER -->

                <td>

                    <div class="name-box">

                        <h3>{{ $profile->name }}</h3>

                        <p>{{ $profile->email }}</p>

                    </div>

                </td>

                <!-- DESCRIPTION -->

                <td>

                    <div class="desc">

                        {{ \Illuminate\Support\Str::limit($profile->description,120) }}

                    </div>

                </td>

                <!-- SOCIAL -->

                <td>

                    @php

                        $platforms = [];

                        if(!empty($profile->platforms))
                        {
                            $decodedPlatforms = json_decode($profile->platforms, true);

                            if(is_array($decodedPlatforms))
                            {
                                $platforms = $decodedPlatforms;
                            }
                        }

                    @endphp

                    <div class="social-icons">

                        @if(is_array($platforms) && in_array('facebook', $platforms))

                            <span class="fb">

                                <i class="fab fa-facebook-f"></i>

                            </span>

                        @endif

                        @if(is_array($platforms) && in_array('instagram', $platforms))

                            <span class="insta">

                                <i class="fab fa-instagram"></i>

                            </span>

                        @endif

                    </div>

                </td>

                <!-- STATUS -->

                <td>

                    @if($profile->status == 'publish')

                        <span class="badge publish">

                            🚀 Published

                        </span>

                    @elseif($profile->status == 'draft')

                        <span class="badge draft">

                            📝 Draft

                        </span>

                    @else

                        <span class="badge archive">

                            📦 Archived

                        </span>

                    @endif

                </td>

                <!-- ACTION -->

                <td>

                    <div class="action-box">

                        <a href="{{ route('profiles.show',$profile->id) }}"
                           class="action-btn view-btn">

                           👁

                        </a>

                        <a href="{{ route('profiles.edit',$profile->id) }}"
                           class="action-btn edit-btn">

                           ✏

                        </a>

                        <a href="{{ route('profiles.archive.post',$profile->id) }}"
                           class="action-btn archive-post-btn">

                           📦

                        </a>

                        <form action="{{ route('profiles.destroy',$profile->id) }}"
                              method="POST">

                            @csrf

                            @method('DELETE')

                            <button type="submit"
                                    class="action-btn delete-btn"
                                    onclick="return confirm('Delete this post ?')">

                                🗑

                            </button>

                        </form>

                    </div>

                </td>

            </tr>

            @endforeach

            </tbody>

        </table>

    </div>

</div>

<!-- JQUERY -->

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- DATATABLE -->

<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>

    $(document).ready(function(){

        $('#profileTable').DataTable({

            responsive:true,

            pageLength:5,

            lengthMenu:[5,10,25,50],

            language:{

                search:"🔍 Search :",

                lengthMenu:"Show _MENU_ Posts",

                info:"Showing _START_ to _END_ of _TOTAL_ Posts",

                paginate:{

                    previous:"⬅",

                    next:"➡"

                }

            }

        });

    });

    function toggleTheme()
    {
        document.body.classList.toggle('dark');
    }

</script>

</body>
</html>