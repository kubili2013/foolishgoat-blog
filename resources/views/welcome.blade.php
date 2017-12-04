@extends('layouts.app')
@section('content')
    <div class="page-header" filter-color="gray">
        <div id="div_page_bg" class="page-header-image"></div>
        <div class="container">
            <div class="content-center text-center">
                @if(!auth()->check() || auth()->user()->email == '913493158@qq.com' ||  auth()->user()->avatar == '')
                    <div class="text-center" style="position:relative;display:inline-block;margin:auto 0;height: 100px;width: 100px;box-sizing:content-box;">
                        <div id="logo" class="logo">
                            <div id="left_horn" class="left-horn"></div>
                            <div id="right_horn" class="right-horn"></div>
                            <div id="head" class="head"></div>
                            <div id="face" class="face"></div>
                            <div id="left_glass" class="left-glass"></div>
                            <div id="right_glass" class="right-glass"></div>
                            <div id="left_eye" class="left-eye"></div>
                            <div id="right_eye" class="right-eye"></div>
                            <div id="left_nostril" class="left-nostril"></div>
                            <div id="right_nostril" class="right-nostril"></div>
                            <div class="clearfix" ></div>
                        </div>
                        <div class="clearfix" ></div>
                    </div>
                    <script type="text/javascript">
                        /* 文档加载完成后,设置眼睛移动事件,因为此时 jquery 还没有加载完成,所以用window.onload */
                        window.onload = function () {
                            $(document).mousemove(function(e){removeLogoEyes(e);});
                        }
                    </script>
                @else
                    <div>
                        <img src="{{auth()->user()->avatar}}" class="user-avatar" alt="">
                    </div>
                @endif

                <div class="row" style="width:100%;margin:0px;padding-top:40px;">
                    <div  class="col-xs-3 col-sm-3 col-md-3 text-center" style="padding:0px;">
                        <div id="image_menu_1" class="image-menu" rel="tooltip" title="{{__('Article')}}" _title="{{__('Article')}}" data-placement="bottom">
                            <i class="fa fa-edit"></i>
                        </div>
                    </div>
                    <div class="col-xs-9 col-sm-9 col-md-9 text-center">
                        <div class="row">
                            <div class="col-xs-4 col-sm-4 col-md-4 text-center" style="padding:0px;">
                                <div id="image_menu_2" class="image-menu" rel="tooltip" title="{{__('Share')}}" _title="{{__('Share')}}" data-placement="bottom">
                                    <i class="fa fa-share-alt"></i>
                                </div>
                            </div>
                            <div class="col-xs-8 col-sm-8 col-md-8 text-center" style="padding:0px;">
                                <div id="image_menu_3" class="image-menu" rel="tooltip" title="{{__('Diary')}}" _title="{{__('Diary')}}"data-placement="bottom">
                                    <i class="fa fa-calendar-o"></i>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-8 col-sm-8 col-md-8 text-center" style="padding:0px;">
                                <div id="image_menu_4" class="image-menu" rel="tooltip" title="{{__('Picture')}}" _title="{{__('Picture')}}" data-placement="bottom">
                                    <i class="fa fa-camera"></i>
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 text-center" style="padding:0px;">
                                <div id="image_menu_5" class="image-menu" rel="tooltip" title="{{__('Collection')}}" _title="{{__('Collection')}}" data-placement="bottom">
                                    <i class="fa fa-heart"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script type="text/javascript">
                        /* 文档加载完成后,设置眼睛移动事件,因为此时 jquery 还没有加载完成,所以用window.onload */
                        window.onload = function () {
                            /* 菜单事件 */
                            $('.image-menu').click(function(){
                                switch ($(this).attr('_title')) {
                                    case "{{__('Article')}}": window.location.href="{{route('articles')}}";
                                        break;
                                    case "{{__('Share')}}": window.location.href="{{route('shares')}}";
                                        break;
                                    case "{{__('Diary')}}": window.location.href="{{route('diaries')}}";
                                        break;
                                    case "{{__('Picture')}}": window.location.href="{{route('pictures')}}";
                                        break;
                                    case "{{__('Collection')}}": window.location.href="{{route('collections')}}";
                                        break;
                                }
                            });
                        }
                    </script>
                </div>
            </div>
        {{--</div>--}}
        {{--<div class="container">--}}

        {{--</div>--}}
        <footer class="footer">
            <div class="container">
                <div class="copyright">
                    &copy;
                    <script>
                        document.write(new Date().getFullYear())
                    </script> ⋅ {{__('Code&Design By FoolishGoat')}}
                </div>
            </div>
        </footer>
    </div>
@endsection