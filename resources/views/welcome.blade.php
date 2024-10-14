<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-image: url('https://dealerimages.dealereprocess.com/image/upload/3247042');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            height: 100vh;
        }

        nav {
            background-color: rgba(255, 255, 255, 0.9);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 10px 20px;
            display: flex;
            justify-content: flex-end;
        }

        nav a {
            color: #333;
            text-decoration: none;
            padding: 10px 15px;
            margin-left: 15px;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
            position: relative;
        }

        nav a:hover {
            background-color: #f0f0f0;
            color: #000;
        }

        nav a:focus-visible {
            outline: none;
            box-shadow: 0 0 0 2px #FF2D20;
        }

        nav a::after {
            content: '';
            position: absolute;
            left: 50%;
            bottom: -4px;
            height: 2px;
            width: 0;
            background-color: #FF2D20;
            transition: width 0.3s ease, left 0.3s ease;
        }

        nav a:hover::after,
        nav a:focus-visible::after {
            width: 100%;
            left: 0;
        }

        h1 {
            font-size: 4em;
            margin: 0;
        }

        h2 {
            font-size: 1.5em;
            margin-top: 10px;
            font-weight: normal;
        }
    </style>
</head>

<body>
    @if (Route::has('login'))
    <nav>

        @auth
        <a href="{{ url('/dashboard') }}">
            Dashboard
        </a>
        @else
        <a href="{{ route('login') }}">
            Log in
        </a>

        @if (Route::has('register'))
        <a href="{{ route('register') }}">
            Register
        </a>
        @endif
        @endauth
    </nav>
    @endif
</body>

</html>