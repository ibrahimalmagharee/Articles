<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" href="{{asset('assets/admin/images/logo/logo2.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/admin/images/logo/logo2.png')}}">
    <link rel="stylesheet" href="{{asset('assets/front/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('assets/front/css/style.css')}}">
    <title>@yield('title')</title>
</head>
<body>
@include('site.include.header')

@yield('content')

@include('site.include.footer')


<script>
    function myFunction(imgs) {
        var expandImg = document.getElementById("expandedImg");
        expandImg.src = imgs.src;
    }
</script>
</body>
</html>
