<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">


        <link href="{{asset('/css/app.css')}}" rel="stylesheet">
        <link href="{{asset('/css/styles.css')}}" rel="stylesheet">
        <title>Laravel</title>
        @vite('resources/js/app.js')
        @vite('public/css/styles.css')
        @vite('resources/css/app.css')

    </head>
    <body class="antialiased">
    <div id="app">
        <app-component>
            <h1>Body</h1>
        </app-component>
    </div>

    <script src="{{asset('/js/app.js')}}">

    </script>
    </body>
</html>
