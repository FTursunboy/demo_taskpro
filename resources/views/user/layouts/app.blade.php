<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset('assets/css/main/app.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/main/app-dark.css')}}">
    <link rel="shortcut icon" href="{{asset('assets/images/logo/favicon.svg')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{asset('assets/images/logo/favicon.png')}}" type="image/png">
    <link rel="stylesheet" href="{{asset('assets/css/shared/iconly.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/widgets/chat.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/my-style.css')}}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    @yield('css')
</head>

<body>

<div id="app">
        @include('user.incs.navbar')
    <div id="main" class='layout-navbar'>
        @include('user.incs.header')
        <div id="main-content" class="content">
            @yield('content')
        </div>
    </div>
</div>


<script src="{{asset('assets/js/bootstrap.js')}}"></script>
<script src="{{asset('assets/js/app.js')}}"></script>
<script src="{{asset('assets/extensions/apexcharts/apexcharts.min.js')}}"></script>
<script src="{{asset('assets/js/pages/dashboard.js')}}"></script>
<script src="{{asset('assets/js/my-script.js')}}"></script>

@yield('script')
</body>

</html>
