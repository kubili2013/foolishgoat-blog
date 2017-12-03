@extends('layouts.app')

@section('content')
    <div class="text-center" style="background-image:url('{{$article->thumbnail}}');background-size:100%;padding-bottom:24px;padding-top:82px;margin-bottom:24px;">
        <div class="container">
            <h2 style="color:#dddddd;">{{$article->title}}</h2>
        </div>
    </div>
    <div class="container">
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
                        <span rel="tooltip" title="{{$article->updated_at}}" data-placement="bottom">
                            <i class="fa fa-calendar-o"  style="color:#f96332"></i>&nbsp;<span class="time_enhance">{{__('Updated at')}}{{$article->updated_at->diffForHumans()}}</span>
                        </span>

                    </p>
                    <hr/>
                </div>
            </div>
            <div class="col-lg-12"><div class="markdown-body">{!! $content->content !!}</div></div>
            <hr/>
            <div class="col-lg-12">

                <div style="float:right;">
                    @if(Auth::check() && $article->user->id == Auth::user()->id)
                        <a href="#" rel="tooltip" title="{{__('Open')}}" data-placement="bottom" >
                            <i class="fa fa-envelope-o" style="vertical-align:bottom;"></i>
                            {{-- <i class="fa fa-envelope-open-o" style="vertical-align:bottom;"></i> --}}
                        </a>&nbsp;
                        <a href="#" rel="tooltip" title="{{__('Edit')}}" data-placement="bottom" >
                            <i class="fa fa-cog" style="vertical-align:bottom;"></i>
                        </a>&nbsp;
                        <a href="#" rel="tooltip" title="{{__('Delete')}}" data-placement="bottom" >
                            <i class="fa fa-trash-o" style="vertical-align:bottom;"></i>
                        </a>&nbsp;
                        <a href="#" rel="tooltip" title="{{__('Anchor')}}" data-placement="bottom" >
                            <i class="fa fa-anchor" style="vertical-align:bottom;"></i>
                        </a>&nbsp;
                        <a href="#" rel="tooltip" title="{{__('Up')}}" data-placement="bottom" >
                            <i class="fa fa-thumb-tack" style="vertical-align:bottom;"></i>
                        </a>&nbsp;
                        <a href="#" rel="tooltip" title="{{__('Trophy')}}" data-placement="bottom" >
                            <i class="fa fa-trophy" style="vertical-align:bottom;"></i>
                        </a>&nbsp;
                    @endif

                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
@endsection

@push("title")
{{ $article->title }} -
@endpush

@push("css")
<link rel="stylesheet" type="text/css" href="//cdn.staticfile.org/github-markdown-css/2.5.0/github-markdown.min.css" />
<style>
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
</style>
@endpush
