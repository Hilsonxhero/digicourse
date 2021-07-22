<!doctype html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta name="description"
          content="وب آموز وبسایت آموزش برنامه نویسی وب و موبایل ، جاوااسکریپت ، لاراول ، react ، آموزش node js با مجرب ترین مدرسین">
    <meta name="keywords"
          content="آموزش طراحی سایت,آموزش برنامه نویسی,طراحی وب,ساخت وب سایت,آموزش git,آموزش لاراول,آموزش php,آموزش react,آموزش پی اچ پی,آموزش laravel,آموزش جاوا اسکریپت,آموزش ساخت وب سایت,آموزش mvc,آموزش React Native,وب آموز , وب اموز">
    <link rel="canonical" href="https://webamooz.net"/>
    <meta property="og:title" content="وب آموز | آموزش برنامه‌ نویسی و طراحی وب"/>
    <meta property="og:description"
          content="وب آموز وبسایت آموزش برنامه نویسی وب و موبایل ، جاوااسکریپت ، لاراول ، react ، آموزش node js با مجرب ترین مدرسین"/>
    <meta property="og:url" content="https://webamooz.net"/>
    <meta property="og:site_name" content="وبسایت آموزشی وب آموز"/>
    <meta property="og:brand" content="وب آموز"/>
    <meta property="og:locale" content="fa"/>
    <link rel="stylesheet" href="{{asset('home/assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('home/assets/css/font/font.css')}}">
    <link rel="stylesheet" href="{{asset('home/assets/css/responsive.css')}}" media="(max-width:991px)">
    {{$style ?? ''}}

    <title>{{$title ?? ''}}</title>
</head>
<body>

{{$slot}}


<div class="overlay"></div>


<script src="{{asset('home/assets/js/jquery-3.4.1.min.js')}}"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    @include('Common::feedback')
</script>
{{$script ?? ''}}
<script src="{{asset('home/assets/js/js.js')}}"></script>
<script src="{{asset('home/assets/js/countDownTimer.js')}}"></script>
<script src="{{asset('home/assets/js/activation-code.js')}}"></script>
</body>
</html>
