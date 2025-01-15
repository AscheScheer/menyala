<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login/Register</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            background-image: url('https://laravel.com/assets/img/welcome/background.svg');
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            background: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            width: 350px;
            text-align: center;
            padding: 20px;
        }

        .card h1 {
            color: #000000;
            /* Laravel's red */
            margin-bottom: 20px;
        }

        .button {
            display: inline-block;
            width: 100%;
            padding: 10px 0;
            margin: 10px 0;
            font-size: 16px;
            color: white;
            background-color: #262C34;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        .button:hover {
            background-color: #d9261b;
        }
    </style>
</head>

<body>
    <div class="card">
        <h1>Welcome</h1>
        @if (Route::has('login'))
            @auth
                <a href="{{ url('/dashboard') }}" class="button">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="button">Login</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="button">Register</a>
                @endif
            @endauth
    </div>
    @endif
</body>

</html>
