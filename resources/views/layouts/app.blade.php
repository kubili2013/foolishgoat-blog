<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="">
    <link rel="icon" type="image/png" href="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>@stack('title'){{__('FoolishGoat')}} - @if(auth()->check()){{auth()->user()->name}}@endif {{__('Blog')}}</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <link rel="stylesheet" href="http://apps.bdimg.com/libs/fontawesome/4.2.0/css/font-awesome.min.css">
    @stack('css')
    <link href="{{ asset('css/common.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/sweetalert.css') }}" rel="stylesheet" />

</head>

<body class="login-page sidebar-collapse">

@component('layouts.components.nav')
@endcomponent
{{-- 主体内容 --}}
@yield('content')

@if( request()->path() != '/')
{{-- 尾部 --}}
@component('layouts.components.footer')
@endcomponent
@endif
</body>
<script src="http://cdn.bootcss.com/highlight.js/8.4/highlight.min.js"></script>
<!-- jquery boostrap popper -->
<script src="{{ asset('js/jquery.3.2.1.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/popper.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/bootstrap.min.js') }}" type="text/javascript"></script>
<!-- bootstrap-datepicker bootstrap-switch jquery-sharrre nouislider -->
<script src="{{ asset('js/plugin.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/marked.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/sweetalert.min.js') }}" type="text/javascript"></script>
@stack('scripts')

{{--@if( request()->path() != '/article/create')--}}
    {{-- 创建文章需要引入的js插件 --}}
    {{--@component('layouts.components.include_create_article')--}}
    {{--@endcomponent--}}
{{--@endif--}}
<!-- now-ui -->
<script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
<!-- now-ui -->
<script type="text/javascript">
    $(function(){
        $("#search-str").keydown(function (e) {
            if (e.keyCode == 13) {
                to();
            }
        });
        // simeditor 图片宽度问题
        $(".markdown-body img").removeAttr("height");
    });
    function deleteCheck(href){
        swal({
            title: "{{__('Do you want to delete it?')}}",
            text: "",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "{{__('I am sure!')}}",
            cancelButtonText:"{{__('Cancel')}}",
            closeOnConfirm: false
        },
        function(){
            window.location.href = href;
        });
    }
</script>
@if(!auth()->check() || auth()->user()->email == '913493158@qq.com')
    <script src="{{ asset('js/mine.js') }}" type="text/javascript"></script>
@endif
</html>