@extends('layouts.app')

@section('content')
    <div class="text-center" style="background-image:url('{{$article->thumbnail}}');background-size:100%;padding-bottom:24px;padding-top:82px;">
        <div class="container">
            <h2 style="color:#dddddd;">{{$article->title}}</h2>
            <p>
                @foreach($article->tags as $tag)
                    <span class="badge"  style="background:#f96332;color:#fff;">{{ $tag->tags }}</span>&nbsp;&nbsp;
                @endforeach
            </p>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <div class="panel panel-default" style="margin-top:24px;margin-bottom: 24px;border:1px solid #ddd;padding:24px 15px;">
                    <div class="row justify-content-md-center">
                        <div class="col-lg-12">
                            <p style="padding-left:30px;margin-bottom: 0px;color:#333;">
                        <span rel="tooltip" title="{{__('Author')}}" data-placement="bottom">
                            <i class="fa fa-user" style="color:#f96332" ></i>&nbsp;<span>{{$article->user->name}}</span>
                        </span> &nbsp;⋅&nbsp;
                        <span rel="tooltip" title="{{__('Total Reading')}}" data-placement="bottom">
                            <i class="fa fa-eye" style="color:#f96332" ></i>&nbsp;<span>{{$article->view_number}}</span>
                        </span> &nbsp;⋅&nbsp;
                        <span rel="tooltip" title="{{__('Favorite')}}" data-placement="bottom" >
                            <i class="fa fa-thumbs-o-up"  style="color:#f96332"></i>&nbsp;<span>{{$article->upvote_number}}</span>
                        </span> &nbsp;⋅&nbsp;
                        <span rel="tooltip" title="{{__('Comment')}}" data-placement="bottom">
                            <i class="fa fa-comment-o"  style="color:#f96332"></i>&nbsp;<span class="time_enhance">{{$article->comments->count()}}</span>
                        </span> &nbsp;⋅&nbsp;
                        <span rel="tooltip" title="{{$article->created_at}}" data-placement="bottom">
                            <i class="fa fa-calendar-o"  style="color:#f96332"></i>&nbsp;<span class="time_enhance">{{__('Created at')}}{{$article->created_at->diffForHumans()}}</span>
                        </span>

                            </p>
                            <hr/>
                        </div>
                    </div>
                    <div class="col-lg-12"><div class="markdown-body">{!! $content->content !!}</div></div>
                    <hr/>
                    <div class="col-lg-12">
                        <div style="float:left"><div class="social-share"></div></div>
                        <div style="float:right;">
                            @if(Auth::check() && $article->user->id == Auth::user()->id)
                                <a href="{{route('article.edit',['article'=>$article->id])}}" rel="tooltip" title="{{__('Edit')}}" data-placement="bottom" >
                                    <i class="fa fa-cog" style="vertical-align:bottom;"></i>
                                </a>&nbsp;
                                <a href="#" rel="tooltip" title="{{__('Delete')}}" data-placement="bottom"  onclick="deleteCheck('{{route('article.trash',['article'=>$article->id])}}');" >
                                    <i class="fa fa-trash-o" style="vertical-align:bottom;"></i>
                                </a>&nbsp;
                                {{--<a href="#" rel="tooltip" title="{{__('Anchor')}}" data-placement="bottom" >--}}
                                    {{--<i class="fa fa-anchor" style="vertical-align:bottom;"></i>--}}
                                {{--</a>&nbsp;--}}
                                {{--<a href="#" rel="tooltip" title="{{__('Up')}}" data-placement="bottom" >--}}
                                    {{--<i class="fa fa-thumb-tack" style="vertical-align:bottom;"></i>--}}
                                {{--</a>&nbsp;--}}
                                {{--<a href="#" rel="tooltip" title="{{__('Trophy')}}" data-placement="bottom" >--}}
                                    {{--<i class="fa fa-trophy" style="vertical-align:bottom;"></i>--}}
                                {{--</a>&nbsp;--}}
                            @endif

                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="panel panel-default" style="margin-top:24px;margin-bottom: 24px;border:1px solid #ddd;padding:24px 15px;">
                    <div class="row justify-content-md-center">
                        <div class="col-lg-12 text-center">
                            <button id="btn_favorite" class="btn btn-primary" onclick="favorite();">{{__('Favorite')}}</button>
                            <button id="btn_detach_favorite" class="btn btn-primary" style="display: none" onclick="detachFavorite();">{{__('Detach Favorite')}}</button>

                            <script>
                                function favorite(){
                                    @if(!auth()->check())
                                        window.location.href = "{{route('login')}}";
                                        return;
                                    @endif
                                    $.get("{{route("article.favorite",["id"=>$article->id])}}",function(data){
                                        $("#upvote_users").append(
                                                '<img id="favorite_user_' + data.id + '" class="rounded-circle img-raised" style="width:40px;" src="'
                                                + data.avatar + '">');
                                    });
                                    $("#btn_favorite").hide();
                                    $("#btn_detach_favorite").show();
                                }
                                function detachFavorite(){
                                    @if(!auth()->check())
                                            window.location.href = "{{route('login')}}";
                                    return;
                                    @endif
                                    $.get("{{route("article.detach.favorite",["id"=>$article->id])}}",function(data){
                                        $("#favorite_user_" + data.id).remove();
                                    });
                                    $("#btn_detach_favorite").hide();
                                    $("#btn_favorite").show();
                                }
                            </script>
                        </div>
                        <div class="col-lg-12 text-center" id="upvote_users" style="padding:15px;">
                            @foreach($article->upusers as $user)
                                @if(auth()->user()->id == $user->id)
                                    <script>
                                        window.onload = function (){
                                            $("#btn_favorite").hide();
                                            $("#btn_detach_favorite").show();
                                        };
                                    </script>
                                @endif
                                <img class="rounded-circle img-raised" id="favorite_user_{{$user->id}}" style="width:40px;" src="{{$user->avatar}}" alt="">
                            @endforeach
                        </div>
                    </div>
                </div>
                @if($article->comments->count())
                    <div class="panel panel-default" style="margin-top:24px;margin-bottom: 24px;border:1px solid #ddd;padding:24px 0px;">

                        @foreach($article->comments as $comment)
                            <div class="media" style="padding: 5px 20px">
                                <div class="media-left"><img src="{{$comment->user->avatar}}" class="rounded-circle" style="width:60px; float:right;" alt=""></div>
                                <div class="media-body" style="padding-left:10px;">
                                    <p style="font-weight: 900">{{$comment->user->name}}&nbsp;⋅&nbsp;{{$comment->created_at->diffForHumans()}}</p>
                                    <hr>
                                    {!! $comment->body !!}
                                </div>
                            </div>

                        @endforeach
                    </div>
                @endif
                <div class="panel panel-default" style="margin-top:24px;margin-bottom: 24px;border:1px solid #ddd;padding:24px 15px;">
                    <div class="row justify-content-md-center">
                        <div class="col-lg-12">
                            @include('article.comment_form')
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="panel panel-default" style="margin-top:24px;margin-bottom: 24px;border:1px solid #ddd;padding:24px 15px;">
                    <div class="row justify-content-md-center">
                        <div class="col-lg-12 text-center">
                            <img class="rounded-circle img-raised" src="{{$article->user->avatar}}" alt="">
                        </div>
                        <div class="col-lg-12 text-center">
                            <h3 class="title">{{$article->user->name}}</h3>
                            {{--<p class="category">{{$article->user->id}}</p>--}}
                        </div>
                        <div class="col-lg-12 text-center">
                            <div class="row">
                                <div class="col-lg-4 col-4 text-center">
                                    <h6 style="color:#f96332;margin-bottom:2px;">{{$article->user->articles()->count()}}</h6>
                                    <h5 style="color:#f96332;"><i class="fa fa-edit"></i></h5>

                                </div>
                                <div class="col-lg-4 col-4 text-center">
                                    <h6 style="color:#f96332;margin-bottom:2px;">{{$article->user->comments()->count()}}</h6>
                                    <h5 style="color:#f96332;"><i class="fa fa-comment"></i></h5>

                                </div>
                                <div class="col-lg-4 col-4 text-center">
                                    <h6 style="color:#f96332;margin-bottom:2px;">{{$article->user->articles()->count()}}</h6>
                                    <h5 style="color:#f96332;"><i class="fa fa-share-alt"></i></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push("title")
{{ $article->title }} -
@endpush

@push("css")
<link rel="stylesheet" type="text/css" href="//cdn.staticfile.org/github-markdown-css/2.5.0/github-markdown.min.css" />
<link rel="stylesheet" type="text/css" href="{{asset('css/share.min.css')}}" />

<style>

    .list-group-item{
        border:none;
    }
    .comment-list-group-item:last-child{
        border:none;
    }
    .comment-list-group-item{
        border-bottom: 1px solid rgba(0,0,0,0.88);
    }
    .markdown-body {
        box-sizing: border-box;
        min-width: 200px;
        max-width: 980px;
        margin: 0 auto;
        padding: 30px;
    }

    @media (max-width: 767px) {
        .markdown-body {
            padding: 15px;
        }
    }
    a:hover{
        text-decoration: none;
    }
    a:active{
        text-decoration: none;
    }
    .social-share .social-share-icon{
        width:18px;
        height:18px;
        line-height:18px;
        font-size: 12px;
    }
</style>
@endpush

@push('scripts')

{{--<script type="text/javascript" src="{{ asset('plugin/simditor/scripts/jquery.min.js') }}"></script>--}}
<script type="text/javascript" src="{{ asset('js/social-share.min.js') }}"></script>
@endpush
