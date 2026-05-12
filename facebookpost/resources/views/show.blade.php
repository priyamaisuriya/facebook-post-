<!-- resources/views/show.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        Facebook Post Details
    </title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', sans-serif;
        }

        body {
            background:
                linear-gradient(135deg,
                    #dbeafe,
                    #eef2ff,
                    #f8fafc);

            min-height: 100vh;
            padding: 35px;
        }

        /* CONTAINER */

        .container {
            max-width: 1450px;
            margin: auto;
        }

        /* HEADER */

        .topbar {

            background:
                linear-gradient(135deg,
                    #2563eb,
                    #4f46e5,
                    #7c3aed);

            border-radius: 35px;

            padding: 45px;

            color: white;

            margin-bottom: 30px;

            box-shadow:
                0 20px 50px rgba(37, 99, 235, 0.25);

            position: relative;

            overflow: hidden;
        }

        .topbar::before {

            content: '';

            position: absolute;

            width: 250px;
            height: 250px;

            background:
                rgba(255, 255, 255, 0.1);

            border-radius: 50%;

            top: -80px;
            right: -80px;
        }

        .topbar h1 {
            font-size: 45px;
            margin-bottom: 12px;
            position: relative;
            z-index: 2;
        }

        .topbar p {
            font-size: 18px;
            opacity: 0.95;
            position: relative;
            z-index: 2;
        }

        /* GRID */

        .grid {

            display: grid;

            grid-template-columns:
                1.7fr 1fr;

            gap: 30px;
        }

        /* CARD */

        .card {

            background: white;

            border-radius: 30px;

            padding: 30px;

            box-shadow:
                0 10px 35px rgba(0, 0, 0, 0.08);

            transition: 0.3s;
        }

        .card:hover {

            transform: translateY(-3px);
        }

        /* PROFILE */

        .profile-top {

            display: flex;

            align-items: center;

            gap: 20px;

            margin-bottom: 25px;
        }

        .avatar {

            width: 95px;
            height: 95px;

            border-radius: 50%;

            background:
                linear-gradient(135deg,
                    #2563eb,
                    #7c3aed);

            display: flex;

            justify-content: center;
            align-items: center;

            font-size: 38px;

            color: white;

            box-shadow:
                0 10px 20px rgba(37, 99, 235, 0.25);
        }

        .profile-top h2 {

            font-size: 32px;

            color: #0f172a;

            margin-bottom: 5px;
        }

        .profile-top p {

            color: #64748b;

            font-size: 16px;
        }

        /* DESCRIPTION */

        .description {

            background: #f8fafc;

            padding: 25px;

            border-radius: 22px;

            line-height: 1.9;

            color: #334155;

            font-size: 17px;

            margin-bottom: 25px;

            border-left:
                5px solid #2563eb;
        }

        /* BADGES */

        .badges {

            display: flex;

            flex-wrap: wrap;

            gap: 12px;

            margin-bottom: 30px;
        }

        .badge {

            padding: 12px 18px;

            border-radius: 50px;

            background:
                linear-gradient(135deg,
                    #eff6ff,
                    #dbeafe);

            color: #2563eb;

            font-weight: bold;

            box-shadow:
                0 5px 10px rgba(37, 99, 235, 0.1);
        }

        /* SECTION TITLE */

        .section-title {

            font-size: 28px;

            color: #0f172a;

            margin-bottom: 22px;

            font-weight: bold;
        }

        /* MEDIA */

        .media-grid {

            display: grid;

            grid-template-columns:
                repeat(auto-fill, minmax(200px, 1fr));

            gap: 20px;
        }

        .media-item {

            position: relative;

            overflow: hidden;

            border-radius: 25px;

            background: #f1f5f9;
        }

        .media-item img,
        .media-item video {

            width: 100%;
            height: 230px;

            object-fit: cover;

            border-radius: 25px;

            transition: 0.4s;
        }

        .media-item:hover img,
        .media-item:hover video {

            transform: scale(1.05);
        }

        /* ANALYTICS */

        .stats {

            display: grid;

            grid-template-columns:
                1fr 1fr;

            gap: 18px;
        }

        .stat-box {

            background:
                linear-gradient(135deg,
                    #eff6ff,
                    #eef2ff);

            padding: 28px;

            border-radius: 25px;

            text-align: center;

            transition: 0.3s;
        }

        .stat-box:hover {

            transform: translateY(-5px);
        }

        .stat-box i {

            font-size: 35px;

            margin-bottom: 15px;

            color: #2563eb;
        }

        .stat-box h2 {

            font-size: 34px;

            color: #0f172a;
        }

        .stat-box p {

            margin-top: 8px;

            color: #64748b;

            font-weight: bold;
        }

        /* COMMENTS */

        .comment-box {

            background: #f8fafc;

            padding: 18px;

            border-radius: 22px;

            margin-bottom: 18px;

            border-left:
                5px solid #2563eb;

            transition: 0.3s;
        }

        .comment-box:hover {

            transform: translateX(6px);
        }

        .comment-top {

            display: flex;

            align-items: center;

            gap: 12px;

            margin-bottom: 12px;
        }

        .comment-avatar {

            width: 50px;
            height: 50px;

            border-radius: 50%;

            background:
                linear-gradient(135deg,
                    #2563eb,
                    #4f46e5);

            display: flex;

            justify-content: center;
            align-items: center;

            color: white;

            font-size: 18px;
        }

        .comment-name {

            font-weight: bold;

            color: #0f172a;
        }

        .comment-text {

            line-height: 1.8;

            color: #475569;
        }

        /* EMPTY */

        .no-comment {

            text-align: center;

            padding: 40px;

            color: #64748b;

            font-size: 18px;
        }

        /* BUTTON */

        .back-btn {

            display: inline-block;

            margin-top: 35px;

            background:
                linear-gradient(135deg,
                    #2563eb,
                    #4f46e5);

            color: white;

            padding: 16px 28px;

            border-radius: 18px;

            text-decoration: none;

            font-weight: bold;

            transition: 0.3s;
        }

        .back-btn:hover {

            transform: translateY(-4px);

            box-shadow:
                0 10px 20px rgba(37, 99, 235, 0.25);
        }

        /* RESPONSIVE */

        @media(max-width:950px) {

            .grid {
                grid-template-columns: 1fr;
            }

            body {
                padding: 20px;
            }

            .topbar {
                padding: 30px;
            }

            .topbar h1 {
                font-size: 34px;
            }

        }
    </style>

</head>

<body>

    <div class="container">

        <!-- TOP HEADER -->

        <div class="topbar">

            <h1>
                📘 Facebook Post Details
            </h1>

            <p>
                Full Post Analytics, Media & Live Comments
            </p>

        </div>

        <div class="grid">

            <!-- LEFT SECTION -->

            <div class="card">

                <div class="profile-top">

                    <div class="avatar">
                        👤
                    </div>

                    <div>

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

                    @if($profile->tags)

                        <div class="badge">

                            🏷 {{ $profile->tags }}

                        </div>

                    @endif

                    @if($profile->hashtags)

                        <div class="badge">

                            🔥 {{ $profile->hashtags }}

                        </div>

                    @endif

                    @if($profile->status)

                        <div class="badge">

                            📌 {{ ucfirst($profile->status) }}

                        </div>

                    @endif

                </div>

                <!-- IMAGES -->

                @if($profile->images)

                    <div class="section-title">

                        📸 Uploaded Images

                    </div>

                    <div class="media-grid">

                        @foreach(json_decode($profile->images) as $image)

                            <div class="media-item">

                                <img src="{{ asset('uploads/profiles/' . $image) }}">

                            </div>

                        @endforeach

                    </div>

                @endif

                <br>

                <!-- VIDEOS -->

                @if($profile->videos)

                    <div class="section-title">

                        🎥 Uploaded Videos

                    </div>

                    <div class="media-grid">

                        @foreach(json_decode($profile->videos) as $video)

                            <div class="media-item">

                                <video controls>

                                    <source src="{{ asset('uploads/videos/' . $video) }}" type="video/mp4">

                                </video>

                            </div>

                        @endforeach

                    </div>

                @endif

                <a href="{{ route('profiles.index') }}" class="back-btn">

                    ← Back To Dashboard

                </a>

            </div>

            <!-- RIGHT SECTION -->

            <div>

                <!-- ANALYTICS -->

                <div class="card">

                    <div class="section-title">

                        📊 Facebook Analytics

                    </div>

                    <div class="stats">

                        <div class="stat-box">

                            <i class="fa-solid fa-thumbs-up"></i>

                            <h2>

                                {{ $data['likes']['summary']['total_count'] ?? 0 }}

                            </h2>

                            <p>
                                Likes
                            </p>

                        </div>

                        <div class="stat-box">

                            <i class="fa-solid fa-comment"></i>

                            <h2>

                                {{ isset($data['comments']['data']) ? count($data['comments']['data']) : 0 }}

                            </h2>

                            <p>
                                Comments
                            </p>

                        </div>

                        <div class="stat-box">

                            <i class="fa-solid fa-share"></i>

                            <h2>

                                {{ $data['shares']['count'] ?? 0 }}

                            </h2>

                            <p>
                                Shares
                            </p>

                        </div>

                        <div class="stat-box">

                            <i class="fa-solid fa-eye"></i>

                            <h2>

                                {{ $data['impressions'] ?? '25K' }}

                            </h2>

                            <p>
                                Reach
                            </p>

                        </div>

                    </div>

                </div>

                <br>

                <!-- COMMENTS -->

                <div class="card">

                    <div class="section-title">

                        💬 Facebook Comments

                    </div>

                    @if(
                            isset($data['comments']['data']) &&
                            count($data['comments']['data']) > 0
                        )

                        @foreach($data['comments']['data'] as $comment)

                            <div class="comment-box">

                                <div class="comment-top">

                                    <div class="comment-avatar">
                                        👤
                                    </div>

                                    <div class="comment-name">

                                        {{ $comment['from']['name'] ?? 'Facebook User' }}

                                    </div>

                                </div>

                                <div class="comment-text">

                                    {{ $comment['message'] ?? 'No Comment' }}

                                </div>

                            </div>

                        @endforeach

                    @else

                        <div class="no-comment">

                            😔 No Facebook Comments Found

                        </div>

                    @endif

                </div>

            </div>

        </div>

    </div>

</body>

</html>