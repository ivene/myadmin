<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no, viewport-fit=cover">
    <meta name="format-detection" content="telephone=no,email=no"/>
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
    <meta name="x5-fullscreen" content="true"/>
    <meta name="full-screen" content="true"/>
    <title>CEC能量链 - @yield('title')</title>
    <meta name="keywords" content="{{ config('app.name', 'CEC 能量链') }} @yield('keywords')">
    <meta name="description" content="{{ config('app.name', 'CEC 能量链') }} @yield('desc')">
    @include('front.css')
    <!-- jQuery 3 -->
    <script src="{{asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
    <style type="text/css">
        @media screen and (max-width:800px) {
            .content{
                margin-top: 50px;
            }
        }
    </style>

    @yield('css')
</head>
<body>
@include('front.header')
@yield('content')
@include('front.js')
@yield('js')
<script type="text/javascript">
    function setLocal(language){
        $.ajax({
            type:"GET",
            dataType:"json",
            url:"/cec/language?local="+language,
            success: function (result) {
                if (result.code == "10000") {
                    window.location.reload();
                }
            },
        });
        return false;
    }
</script>
</body>
</html>