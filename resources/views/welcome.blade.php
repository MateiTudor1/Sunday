<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">


        <link href="{{asset('resources/css/app.css')}}" rel="stylesheet">
        <title>Laravel</title>
        @vite('resources/js/app.js')

    </head>
    <body class="antialiased">
    <div id="app">
        <app-component>
            <h1>Body</h1>
        </app-component>
    </div>

    <script src="{{asset('resources/js/app.js')}}">

    </script>
    </body>
</html>
