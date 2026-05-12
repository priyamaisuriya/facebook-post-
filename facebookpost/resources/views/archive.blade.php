<!-- resources/views/archive.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        Archived Posts
    </title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background:
                linear-gradient(135deg,
                    #dbeafe,
                    #eef4ff);

            min-height: 100vh;
            padding: 35px;
        }

        .container {
            max-width: 1400px;
            margin: auto;
        }

        .topbar {
            background:
                linear-gradient(135deg,
                    #0f172a,
                    #1e293b);

            padding: 35px;
            border-radius: 30px;
            color: white;
            margin-bottom: 30px;

            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;

            box-shadow:
                0 15px 40px rgba(0, 0, 0, 0.08);
        }

        .topbar h1 {
            font-size: 40px;
            margin-bottom: 8px;
        }

        .topbar p {
            opacity: 0.9;
            font-size: 17px;
        }

        .back-btn {
            background: white;
            color: #0f172a;
            padding: 15px 22px;
            border-radius: 16px;
            text-decoration: none;
            font-weight: bold;
            transition: 0.3s;
        }

        .back-btn:hover {
            transform: translateY(-3px);
        }

        .grid {
            display: grid;
            grid-template-columns:
                repeat(auto-fill, minmax(360px, 1fr));

            gap: 25px;
        }

        .card {
            background: white;
            border-radius: 30px;
            overflow: hidden;

            box-shadow:
                0 10px 30px rgba(0, 0, 0, 0.06);

            transition: 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .media {
            width: 100%;
            height: 260px;
            overflow: hidden;
            background: #f1f5f9;
        }

        .media img,
        .media video {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .card-body {
            padding: 25px;
        }

        .profile-top {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
        }

        .avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;

            background:
                linear-gradient(135deg,
                    #2563eb,
                    #4f46e5);

            display: flex;
            justify-content: center;
            align-items: center;

            color: white;
            font-size: 24px;
        }

        .profile-info h2 {
            color: #0f172a;
            font-size: 22px;
        }

        .profile-info p {
            color: #64748b;
            margin-top: 5px;
        }

        .description {
            color: #475569;
            line-height: 1.8;
            margin-bottom: 20px;
        }

        .badges {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        .badge {
            background: #eff6ff;
            color: #2563eb;
            padding: 10px 14px;
            border-radius: 50px;
            font-size: 13px;
            font-weight: bold;
        }

        .stats {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 15px;
            margin-top: 20px;
        }

        .stat {
            background: #f8fafc;
            padding: 18px;
            border-radius: 18px;
            text-align: center;
        }

        .stat i {
            color: #2563eb;
            margin-bottom: 10px;
            font-size: 20px;
        }

        .stat h3 {
            color: #0f172a;
            font-size: 20px;
        }

        .stat p {
            color: #64748b;
            margin-top: 5px;
            font-size: 14px;
        }

        .action-btns {
            display: flex;
            gap: 12px;
            margin-top: 25px;
        }

        .view-btn,
        .restore-btn {
            flex: 1;
            text-align: center;
            padding: 14px;
            border-radius: 15px;
            text-decoration: none;
            font-weight: bold;
            transition: 0.3s;
        }

        .view-btn {
            background: #2563eb;
            color: white;
        }

        .restore-btn {
            background: #16a34a;
            color: white;
        }

        .view-btn:hover,
        .restore-btn:hover {
            transform: translateY(-3px);
        }

        .empty-box {
            background: white;
            padding: 80px 30px;
            border-radius: 30px;
            text-align: center;

            box-shadow:
                0 10px 30px rgba(0, 0, 0, 0.05);
        }

        .empty-box i {
            font-size: 70px;
            color: #94a3b8;
            margin-bottom: 20px;
        }

        .empty-box h2 {
            color: #0f172a;
            margin-bottom: 10px;
        }

        .empty-box p {
            color: #64748b;
        }

        @media(max-width:768px) {

            body {
                padding: 20px;
            }

            .topbar {
                flex-direction: column;
                align-items: flex-start;
            }

            .topbar h1 {
                font-size: 32px;
            }

        }
    </style>

</head>

<body>

    <div class="container">

        <!-- TOPBAR -->

        <div class="topbar">

            <div>

                <h1>
                    📦 Archived Posts
                </h1>

                <p>
                    All your archived social media posts
                </p>

            </div>

            <a href="{{ route('profiles.index') }}" class="back-btn">

                ← Back Dashboard

            </a>

        </div>

        <!-- POSTS -->

        @if($profiles->count() > 0)

            <div class="grid">

                @foreach($profiles as $profile)

                    <div class="card">

                        <!-- IMAGE -->

                        @if($profile->images)

                            @php
                                $images = json_decode($profile->images);
                            @endphp

                            @if(isset($images[0]))

                                                <div class="media">

                                                    <img src="
                                {{ asset('uploads/profiles/' . $images[0]) }}
                                ">

                                                </div>

                            @endif

                        @elseif($profile->videos)

                            @php
                                $videos = json_decode($profile->videos);
                            @endphp

                            @if(isset($videos[0]))

                                                <div class="media">

                                                    <video controls>

                                                        <source src="
                                {{ asset('uploads/videos/' . $videos[0]) }}
                                ">

                                                    </video>

                                                </div>

                            @endif

                        @endif

                        <div class="card-body">

                            <!-- PROFILE -->

                            <div class="profile-top">

                                <div class="avatar">
                                    👤
                                </div>

                                <div class="profile-info">

                                    <h2>
                                        {{ $profile->name }}
                                    </h2>

                                    <p>
                                        {{ $profile->email }}
                                    </p>

                                </div>

                            </div>

                            <!-- DESCRIPTION -->

                            <div class="description">

                                {{ $profile->description }}

                            </div>

                            <!-- BADGES -->

                            <div class="badges">

                                @if($profile->hashtags)

                                    <div class="badge">

                                        🔥 {{ $profile->hashtags }}

                                    </div>

                                @endif

                                @if($profile->tags)

                                    <div class="badge">

                                        🏷 {{ $profile->tags }}

                                    </div>

                                @endif

                                <div class="badge">

                                    📦 Archived

                                </div>

                            </div>

                            <!-- STATS -->

                            <div class="stats">

                                <div class="stat">

                                    <i class="fa-solid fa-thumbs-up"></i>

                                    <h3>
                                        2.5K
                                    </h3>

                                    <p>
                                        Likes
                                    </p>

                                </div>

                                <div class="stat">

                                    <i class="fa-solid fa-comment"></i>

                                    <h3>
                                        450
                                    </h3>

                                    <p>
                                        Comments
                                    </p>

                                </div>

                                <div class="stat">

                                    <i class="fa-solid fa-share"></i>

                                    <h3>
                                        120
                                    </h3>

                                    <p>
                                        Shares
                                    </p>

                                </div>

                            </div>

                            <!-- ACTIONS -->

                            <div class="action-btns">

                                <a href="{{ route('profiles.show', $profile->id) }}" class="view-btn">

                                    👁 View

                                </a>

                                <a href="{{ route('profiles.edit', $profile->id) }}" class="restore-btn">

                                    ♻ Restore

                                </a>

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

        @else

            <div class="empty-box">

                <i class="fa-solid fa-box-archive"></i>

                <h2>
                    No Archived Posts Found
                </h2>

                <p>
                    Your archived posts will appear here
                </p>

            </div>

        @endif

    </div>

</body>

</html>