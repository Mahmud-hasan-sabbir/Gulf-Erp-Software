<!DOCTYPE html>

<html lang="en-us" class="no-js">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('public/backend')}}/images/favicon.png">
    <link rel="stylesheet" type="text/css" href="{{asset('public/extra-pages')}}/error/css/style.css">
</head>

<body class="flat">

    <!-- Canvas for particles animation -->
    <div id="particles-js"></div>

    <!-- Your logo on the top left -->
    <a href="{{ url()->previous() }}" class="logo-link" title="back home">
        <img src="{{asset('public')}}/images/logo.png" class="logo" style="width:200px" alt="Company's logo">
    </a>

    <div class="content">
        <div class="content-box">
            <div class="big-content">
                <!-- Main squares for the content logo in the background -->
                <div class="list-square">
                    <span class="square"></span>
                    <span class="square"></span>
                    <span class="square"></span>
                </div>
                <!-- Main lines for the content logo in the background -->
                <div class="list-line">
                    <span class="line"></span>
                    <span class="line"></span>
                    <span class="line"></span>
                    <span class="line"></span>
                    <span class="line"></span>
                    <span class="line"></span>
                </div>
                <!-- The animated searching tool -->
                <i class="fa fa-search" aria-hidden="true"></i>
                <!-- div clearing the float -->
                <div class="clear"></div>
            </div>
            <!-- Your text -->
            <h1>Oops! Error <span style="color: #ff0000;">@yield('code')</span> @yield('message').</h1>
            <p>The page you were looking for doesn't exist.<br>
                We think the page may have moved.</p>
        </div>
    </div>
    <footer class="light">
        <ul>
            <li><a href="#">Support</a></li>
            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
        </ul>
    </footer>
    <script src="{{asset('public/extra-pages')}}/error/js/jquery.min.js"></script>
    <script src="{{asset('public/extra-pages')}}/error/js/bootstrap.min.js"></script>

    <!-- Particles plugin -->
    <script src="{{asset('public/extra-pages')}}/error/js/particles.js"></script>

</body>
</html>
