<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,user-scalable=no,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0">
    <title>拾叁网络</title>
    @include('home.public.css')
</head>
<body>
    @include('home.public.header')
    @yield('content')
    @include('home.public.footer')
    @include('home.public.js')
    @yield('scripts')
</body>
</html>