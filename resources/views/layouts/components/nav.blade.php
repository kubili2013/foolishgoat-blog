
<nav @if( Route::currentRouteName() == 'article.create' || Route::currentRouteName() == 'article.edit' ) class="navbar navbar-expand-lg bg-primary fixed-top"  @else  class="navbar navbar-expand-lg bg-primary fixed-top  navbar-transparent " color-on-scroll="100" @endif>
{{--<nav  @stack('nav-class')color-on-scroll="100" class="navbar navbar-expand-lg bg-primary fixed-top  navbar-transparent " >--}}
    <div class="container">
        <div class="navbar-translate">
            <a class="navbar-brand" href="/" rel="tooltip" title="{{__('Welcome')}}" data-placement="bottom" style="font-size:24px;">
                {{__('FoolishGoat')}}
            </a>
            <button class="navbar-toggler navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse justify-content-end" id="navigation">
            @if(auth()->check())
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <div class="input-group" style="padding-left:15px;padding-right:15px;margin-bottom:0px;">
                            <input id="search-str"  style="color:#fff;" type="text" class="form-control search-bar" placeholder="{{__('Search Key')}}">
                            <span class="input-group-addon" style="background-color:rgba(0,0,0,0);" onclick="to();">
                                <i class="fa fa-search" style="color:#fff"></i>
                            </span>

                        </div>
                        <script>
                            function to(){
                                if($('#search-str').val() == ""){
                                    return false;
                                }else{
                                    window.location.href = "{{route('articles')}}?search=" + $('#search-str').val();
                                    return false;
                                }
                            }

                        </script>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" rel="tooltip" data-toggle="modal" data-target="#choose_type" title="{{__('Add')}}" data-placement="bottom" href="#">
                            <i class="fa fa-plus"></i>
                            <p class="d-lg-none d-xl-none">{{__('Add')}}</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" rel="tooltip" title="{{__('User')}}" data-placement="bottom" href="#">
                            <i class="now-ui-icons users_single-02"></i>
                            <p class="d-lg-none d-xl-none">{{__('User')}}</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" rel="tooltip" title="{{__('Logout')}}" data-placement="bottom" href="{{route('logout')}}">
                            <i class="fa fa-sign-out"></i>
                            <p class="d-lg-none d-xl-none">{{__('Logout')}}</p>
                        </a>
                    </li>
                </ul>
            @else
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <div class="input-group" style="padding-left:15px;padding-right:15px;margin-bottom:0px;">
                            <input id="search-str" style="color:#fff;" type="text" class="form-control search-bar" placeholder="{{__('Search Key')}}">
                            <span class="input-group-addon" style="background-color:rgba(0,0,0,0);" onclick="to();">
                                <i class="fa fa-search" style="color:#fff"></i>
                            </span>
                        </div>
                        <script>
                            function to(){
                                if($('#search-str').val() == ""){
                                    return false;
                                }else{
                                    window.location.href = "{{route('articles')}}?search=" + $('#search-str').val();
                                    return false;
                                }
                            }


                        </script>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" rel="tooltip" title="{{__('Login with Github')}}" data-placement="bottom" href="{{ route("oauth",['name'=>'github']) }}">
                            <i class="fa fa-github"></i>
                            <p class="d-lg-none d-xl-none">{{__('Github')}}</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" rel="tooltip" title="{{__('Login with Weibo')}}" data-placement="bottom" href="{{ route("oauth",['name'=>'weibo']) }}">
                            <i class="fa fa-weibo"></i>
                            <p class="d-lg-none d-xl-none">{{__('Weibo')}}</p>
                        </a>
                    </li>
                </ul>
            @endif
        </div>
    </div>
</nav>
@component('layouts.components.type_modal')
@endcomponent