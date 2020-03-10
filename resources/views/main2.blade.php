<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    
</head>
<body class="bg-gray-100 h-screen antialiased leading-none">
<div class="flex flex-col">

    @include('headerr')
    <div class="min-h-full flex items-center justify-center mt-12">
           @yield('content') 
    </div>
    </div>
</body>
</html>