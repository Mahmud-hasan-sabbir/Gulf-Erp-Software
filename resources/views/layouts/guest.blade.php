<!DOCTYPE html>
<html  lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('public/backend')}}/images/favicon.png">
    <link href="{{asset('public/backend')}}/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="{{asset('public/backend')}}/css/style.css" rel="stylesheet">

</head>

<body class="vh-100" style="background: url('{{asset('public/extra-pages/login')}}/background.jpg');background-size: cover;background-repeat: no-repeat;background-position: center;">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="{{asset('public/backend')}}/vendor/global/global.min.js"></script>
    <script src="{{asset('public/backend')}}/vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="{{asset('public/backend')}}/js/custom.min.js"></script>
    <script src="{{asset('public/backend')}}/js/deznav-init.js"></script>
    <script src="{{asset('public/backend')}}/js/demo.js"></script>
    <script src="{{asset('public/backend')}}/js/styleSwitcher.js"></script>
</body>
</html>
