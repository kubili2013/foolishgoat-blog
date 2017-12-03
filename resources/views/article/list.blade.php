@extends('layouts.app')

@section('content')
    <div class="text-center" style="background-image:url('imgs/1.jpg');background-size:100%;padding-bottom:24px;padding-top:82px;margin-bottom:24px;">
        <h2 style="color:#eee;">{{__('Article List')}}</h2>
    </div>
    <div class="container">

        <div class="row">


            <div class="col-lg-8 col-md-8 col-sm-12">

                <div class="panel panel-default text-center" style="margin-bottom:24px;border:1px solid #ddd;padding:12px 15px;">
                    <a href="{{route("article.create")}}" style="font-size:24px;text-align: center;">
                        <i class="fa fa-plus" ></i>
                    </a>
                </div>

                @if($articles->isEmpty())
                    <div class="panel panel-default" style="margin-bottom:24px;border:1px solid #ddd;padding:24px 16px;">
                        <div class="row">
                            <div class="col-lg-12 text-center">
                                <h3>{{__('Sorry!Have no Articles!')}}</h3>
                            </div>
                        </div>
                    </div>
                @endif
                @foreach($articles as $article)
                    <div class="panel panel-default" style="margin-bottom:24px;border:1px solid #ddd;padding:16px 24px;">
                        <div class="row">
                            <div class="col-lg-3" style="padding:0 5px;"><img src="{{$article->thumbnail}}" alt="" style="width:100%;"></div>
                            <div class="col-lg-9">
                                <h5 class="title">{{$article->title}}</h5>
                                <hr/>
                                <p style="margin-bottom: 0px;color:#333;">
                                    <span rel="tooltip" title="{{__('Author')}}" data-placement="bottom">
                                        <i class="fa fa-user" style="color:#f96332" ></i>&nbsp;<span>{{$article->user->name}}</span>
                                    </span> &nbsp;⋅&nbsp;
                                    <span rel="tooltip" title="{{__('Total Reading')}}" data-placement="bottom">
                                        <i class="fa fa-eye" style="color:#f96332" ></i>&nbsp;<span>{{$article->view_number}}</span>
                                    </span> &nbsp;⋅&nbsp;
                                    <span rel="tooltip" title="{{__('Favorite')}}" data-placement="bottom" >
                                        <i class="fa fa-thumbs-o-up"  style="color:#f96332"></i>&nbsp;<span>{{$article->upvote_number}}</span>
                                    </span> &nbsp;⋅&nbsp;
                                    <span rel="tooltip" title="{{$article->created_at}}" data-placement="bottom">
                                        <i class="fa fa-calendar-o"  style="color:#f96332"></i>&nbsp;<span class="time_enhance">{{__('Created at')}}{{$article->created_at->diffForHumans()}}</span>
                                    </span>

                                </p>
                            </div>
                        </div>
                        <div class="panel-footer operate">
                            <div class="row">
                                <div class="col-lg-6" style="padding-top:10px;padding-left:20px;color:#333;">
                                    @if(Auth::check() && $article->user->id == Auth::user()->id)

                                        <a href="{{route('article.edit',['article'=>$article->id])}}" rel="tooltip" title="{{__('Edit')}}" data-placement="bottom" >
                                            <i class="fa fa-cog" style="vertical-align:bottom;"></i>
                                        </a>&nbsp;
                                        <a href="#" rel="tooltip" title="{{__('Delete')}}" data-placement="bottom" onclick="deleteCheck('{{route('article.trash',['article'=>$article->id])}}');" >
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
                                <div class="col-lg-6">
                                    <a style="float: right;" href="{{route('article.show',["article" => $article->id])}}" class="btn btn-primary btn-simple btn-round btn-sm" target="_blank">{{__('View All')}}</a>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                @endforeach
                {{ $articles -> links("layouts.components.my_pagination") }}
            </div>

            <div class="col-lg-4 col-md-4 col-sm-12">

                <div class="panel panel-default" style="margin-bottom:24px;border:1px solid #ddd;padding:12px 15px;">
                    <div class="row justify-content-md-center" style="padding:15px 15px;">
                        @foreach($tags as $tag)
                            @if(request()->get('tag') == $tag->id)
                                <span href="{{route("articles") ."?tag=".$tag->id}}" class="badge" style="background:#FF3636;color:#fff;">{{ $tag->tags }}</span>&nbsp;&nbsp;
                            @else
                                <a href="{{route("articles") ."?tag=".$tag->id}}" class="badge badge-{{$class[array_rand($class,1)]}}">{{ $tag->tags }}</a>&nbsp;&nbsp;
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection