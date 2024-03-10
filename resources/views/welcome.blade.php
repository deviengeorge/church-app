<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Saint Virgin Mary Church Wadi Hof System</title>
        <!-- @vite('resources/css/app.css') -->
        <style>
            * {
                box-sizing: padding-box;
                margin: 0;
                padding: 0;
                font-family: "sans"
            }
            .link {
                padding: 10px 20px;
                font-size: 16px;
                color: black;
                background-color: white;
                border-radius: 10px;
                margin-top: 20px;
            }
            .container {
                display: flex;
                align-items: center;
                justify-content: center;
                flex-direction: column;
                height: 100vh;
                width: 100vw;
                background-color: #202020;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div>
                <img src="{{ asset('/church-logo.jpeg') }}" alt="Chruch Logo">
            </div>
            <a href="admin" class="link">Go To System</a>
        </div>
    </body>
</html>
