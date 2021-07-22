<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="_token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel</title>
    <!-- jQuery Modal -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css"/>
    <link rel="stylesheet" href="{{asset('panel/assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('panel/assets/css/responsive_991.css')}}" media="(max-width:991px)">
    <link rel="stylesheet" href="{{asset('panel/assets/css/responsive_768.css')}}" media="(max-width:768px)">
    <link rel="stylesheet" href="{{asset('panel/assets/css/font.css')}}">
    <link rel="stylesheet" href="{{asset('panel/assets/css/c3.min.css')}}"/>

</head>
<body>
@include('Dashboard::layout.sidebar')
<div class="content">
    @include('Dashboard::layout.header')

    {{$breadcrumb ?? ''}}
    {{$slot}}
</div>


</body>


<script src="{{asset('panel/assets/js/jquery-3.4.1.min.js')}}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- jQuery Modal -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>

<script>
    @include('Common::feedback')
</script>
<script src="{{asset('panel/assets/js/tagsInput.js')}}"></script>
<script src="{{asset('panel/assets/js/c3.bundle.js')}}"></script>
<script src="{{asset('panel/assets/js/c3.js')}}"></script>
<script src="{{asset('panel/assets/js/js.js?v=2')}}"></script>

{{$script ?? ''}}

</html>
