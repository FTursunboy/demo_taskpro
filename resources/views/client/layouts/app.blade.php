<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="{{asset('assets/css/main/app.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/main/app-dark.css')}}">
    <link rel="shortcut icon" href="{{asset('assets/images/logo/favicon.svg')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{asset('assets/images/logo/favicon.png')}}" type="image/png">
    <link rel="stylesheet" href="{{asset('assets/css/shared/iconly.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/widgets/chat.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/my-style.css')}}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>
<div id="app">
    @include('client.incs.navbar')

    <div id="main" class='layout-navbar'>
        @include('client.incs.header')
        <div id="main-content">
            @yield('content')
        </div>
    </div>


</div>


<script src="{{asset('assets/js/bootstrap.js')}}"></script>
<script src="{{asset('assets/js/app.js')}}"></script>

@yield('script')
<script src="{{asset('assets/extensions/apexcharts/apexcharts.min.js')}}"></script>
<script src="{{asset('assets/js/pages/dashboard.js')}}"></script>
<script src="{{asset('assets/js/my-script.js')}}"></script>
<script>
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            window.history.back();
        }
    });

</script>
</body>

</html>
