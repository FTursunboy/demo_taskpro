<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <link rel="stylesheet" href="{{asset('admin/assets/css/main/app.css')}}">
    <link rel="stylesheet" href="{{asset('admin/assets/css/main/app-dark.css')}}">
    <link rel="shortcut icon" href="{{asset('admin/assets/images/logo/favicon.svg')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{asset('admin/assets/images/logo/favicon.png')}}" type="image/png">
    <link rel="stylesheet" href="{{asset('admin/assets/css/shared/iconly.css')}}">
    @yield('content')
</head>

<body>
@include('client.incs.navbar')

@yield('content')




<script src="{{asset('admin/assets/js/bootstrap.js')}}"></script>
<script src="{{asset('admin/assets/js/app.js')}}"></script>

@yield('script')
<script src="{{asset('admin/assets/extensions/apexcharts/apexcharts.min.js')}}"></script>
<script src="{{asset('admin/assets/js/pages/dashboard.js')}}"></script>

</body>

</html>
