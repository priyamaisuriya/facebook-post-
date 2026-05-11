<!DOCTYPE html>
<html>
<head>

    <title>Dashboard</title>

    <style>

        body{
            font-family:Arial;
            background:#f3f4f6;
            display:flex;
            justify-content:center;
            align-items:center;
            height:100vh;
        }

        .box{
            background:white;
            width:400px;
            padding:40px;
            border-radius:20px;
            text-align:center;
            box-shadow:0 0 20px rgba(0,0,0,0.1);
        }

        img{
            width:120px;
            height:120px;
            border-radius:50%;
            object-fit:cover;
            margin-bottom:20px;
        }

        h1{
            color:#1877f2;
        }

        h2{
            margin-top:10px;
        }

        p{
            color:#555;
        }

        a{
            display:inline-block;
            margin-top:20px;
            padding:10px 20px;
            background:#1877f2;
            color:white;
            text-decoration:none;
            border-radius:10px;
        }

    </style>

</head>

<body>

<div class="box">

    <h1>Facebook Login Success</h1>

        @if(auth()->user())

            <img src="{{ auth()->user()->avatar }}">

            <h2>{{ auth()->user()->name }}</h2>

            <p>{{ auth()->user()->email }}</p>

        @else

            <h2>No User Logged In</h2>

        @endif

    <a href="/profiles">
        Go To Profiles
    </a>

</div>

</body>
</html>