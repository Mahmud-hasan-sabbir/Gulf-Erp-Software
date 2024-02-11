<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" zoom="0.8">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.9">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('public/backend')}}/images/favicon.png">
    <!-- Custom Stylesheet -->
	<link href="{{asset('public/backend')}}/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="{{asset('public/backend')}}/css/style.css" rel="stylesheet">
    
    <!-- Jquery -->
    <script src="{{asset('public/backend')}}/js/jquery-3.5.1.min.js"></script>
</head>
<body>
    {{ $slot }}
</body>
</html>