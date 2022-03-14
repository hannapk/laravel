<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="msapplication-tap-highlight" content="no">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="/css/app.css" rel="stylesheet">
    @yield('style')
</head>
    <body id="app-layout">
        @include('layouts.partial.navigation')

        <div class="container">
{{--            @include('flash::message')--}}
            @yield('content')
        </div>

        @include('layouts.partial.footer')

        <script src="/js/app.js"></script>
        @yield('script')
    </body>
</html>
