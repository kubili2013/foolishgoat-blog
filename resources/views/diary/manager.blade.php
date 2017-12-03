@extends('layouts.app')

@section('content')
    <div class="text-center" style="background-image:url('imgs/2.jpg');background-size:100%;padding-bottom:24px;padding-top:82px;margin-bottom:24px;">
        <h2 style="color:#eee;">{{__('Diary List')}}</h2>
    </div>
    <div class="container">
        <div class="row">

            <div class="col-lg-8 col-md-8 col-sm-12">
                <div class="panel panel-default text-center" style="margin-bottom:24px;border:1px solid #ddd;padding:12px 15px;">
                    <a href="#" data-toggle="modal" data-target="#create-diary-modal" style="font-size:24px;text-align: center;">
                        <i class="fa fa-plus" ></i>
                    </a>
                </div>
                @if($diaries->isEmpty())
                    <div class="panel panel-default" style="margin-bottom:24px;border:1px solid #ddd;padding:24px 16px;">
                        <div class="row">
                            <div class="col-lg-12 text-center">
                                <h3>{{__('Sorry!Have no Diary!')}}</h3>
                            </div>
                        </div>
                    </div>
                @endif
                @foreach($diaries as $diary)
                    <div class="panel panel-default" style="margin-bottom:24px;border:1px solid #ddd;padding:16px 24px;">
                        <div class="row">
                            <div class="col-lg-12">
                                <h5 class="title">{{$diary->created_at->format('Y-m-d')}}</h5>
                                <hr/>
                                <div class="markdown-body">{!! $diary->content !!}</div>
                            </div>
                        </div>
                        <div class="panel-footer operate">
                            <div class="row">
                                <div class="col-lg-6">
                                        <span rel="tooltip" title="{{__('Author')}}" data-placement="bottom">
                                            <i class="fa fa-user" style="color:#f96332" ></i>&nbsp;<span>{{$diary->user->name}}</span>
                                        </span> &nbsp;⋅&nbsp;
                                    <span rel="tooltip" title="{{$diary->created_at}}" data-placement="bottom">
                                            <i class="fa fa-calendar-o"  style="color:#f96332"></i>&nbsp;<span class="time_enhance">{{__('Created at')}}{{$diary->created_at->diffForHumans()}}</span>
                                        </span>
                                </div>
                                <div class="col-lg-6 text-right" style="color:#333;">
                                    @if(Auth::check() && $diary->user->id == Auth::user()->id)

                                        {{--<a href="{{route('diary.edit',['diary'=>$diary->id])}}" rel="tooltip" title="{{__('Edit')}}" data-placement="bottom" >--}}
                                            {{--<i class="fa fa-cog" ></i>--}}
                                        {{--</a>&nbsp;--}}
                                        <a href="#" rel="tooltip" title="{{__('Delete')}}" data-placement="bottom" onclick="deleteCheck('{{route('diary.trash',['diary'=>$diary->id])}}');" >
                                            <i class="fa fa-trash-o" ></i>
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

                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                @endforeach
                {{ $diaries -> links("layouts.components.my_pagination") }}
            </div>

            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="panel panel-default" style="margin-bottom: 24px;border:1px solid #ddd;padding:24px 15px;">
                    <div class="row justify-content-md-center">
                        <div class="col-lg-12 text-center">
                            <img class="rounded-circle img-raised" src="{{auth()->user()->avatar}}" alt="">
                        </div>
                        <div class="col-lg-12 text-center">
                            <h3 class="title">{{auth()->user()->name}}</h3>
                            {{--<p class="category">{{$article->user->id}}</p>--}}
                        </div>
                        <div class="col-lg-12 text-center">
                            <div class="row">
                                <div class="col-lg-4 col-4 text-center">
                                    <h6 style="color:#f96332;margin-bottom:2px;">{{auth()->user()->articles()->count()}}</h6>
                                    <h5 style="color:#f96332;"><i class="fa fa-edit"></i></h5>

                                </div>
                                <div class="col-lg-4 col-4 text-center">
                                    <h6 style="color:#f96332;margin-bottom:2px;">{{auth()->user()->comments()->count()}}</h6>
                                    <h5 style="color:#f96332;"><i class="fa fa-comment"></i></h5>

                                </div>
                                <div class="col-lg-4 col-4 text-center">
                                    <h6 style="color:#f96332;margin-bottom:2px;">{{auth()->user()->articles()->count()}}</h6>
                                    <h5 style="color:#f96332;"><i class="fa fa-share-alt"></i></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="create-diary-modal" tabindex="-1" role="dialog" aria-labelledby="create-diary-modal-label">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                {!! Form::open(['route' => 'diary.store']) !!}
                {!! Form::token() !!}
                <div class="modal-header justify-content-center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="title title-up" id="create-diary-modal-label">{{__("Add Diary")}}</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group {{$errors->has('tags')?" has-error":""}}">
                        {!! Form::label('tags', __('Tags') . ($errors->has('tags')? " (" . $errors->first('tags'). ") :" :":"), ['class' => 'control-label ']) !!}
                        {!! Form::text('tags',old('tags'),['class'=>'form-control','placeholder'=> __('Tags')]) !!}
                    </div>
                    <div class="form-group {{$errors->has('content')?" has-error":""}}" style="padding:0px;">
                        {!! Form::label('content', __('Article Content') . ($errors->has('content')? " (" . $errors->first('content'). ") :" : ":"), ['class' => 'control-label']) !!}
                        <div class="editor">
                            {!! Form::textarea('content',old('content'),['class'=>'form-control','rows'=>'20','id'=>'myEditor','placeholder'=> __('Article Content'),"autofocus"=>""]) !!}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{__("Cancel")}}</button>
                    <button type="submit" class="btn btn-primary">{{__("Save")}}</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection
@push('scripts')
{{--<script type="text/javascript" src="{{ asset('plugin/simditor/scripts/jquery.min.js') }}"></script>--}}
<script type="text/javascript" src="{{ asset('plugin/simditor/scripts/module.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugin/simditor/scripts/hotkeys.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugin/simditor/scripts/uploader.js') }}"></script>
<script type="text/javascript" src="//cdn.staticfile.org/simditor/2.3.6/lib/simditor.min.js"></script>
<script type="text/javascript" src="{{ asset('plugin/simditor/scripts/simditor-emoji.js') }}"></script>
<script type="text/javascript" src="//cdn.staticfile.org/to-markdown/3.0.4/to-markdown.min.js"></script>
<script type="text/javascript" src="//cdn.staticfile.org/marked/0.3.6/marked.min.js"></script>

<script type="text/javascript">
    var editor = new Simditor({
        textarea: $('#myEditor'),
        toolbar:['title', 'bold', 'italic', 'underline', 'strikethrough', 'fontScale', 'color', '|', 'ol', 'ul', 'blockquote', 'code', 'table', '|', 'link', 'image', 'hr', '|', 'indent', 'outdent', 'alignment','|','emoji'],
        pasteImage: true,
        emoji: {
            imagePath: '{{ asset('plugin/simditor/images/emoji/') }}'
        },
        upload: {
            url: '{{route('picture.upload')}}',
            params:{
                'type':'diary'
            }
        }
    });

    $(function(){
        @if( $errors->has('tags') || $errors->has('content'))
            $('#create-diary-modal').modal('show');
        @endif
    });
</script>
@endpush

@push("css")
<link rel="stylesheet" type="text/css" href="//cdn.staticfile.org/github-markdown-css/2.5.0/github-markdown.min.css" />
<link rel="stylesheet" type="text/css" href="//cdn.staticfile.org/simditor/2.3.6/styles/simditor.min.css" />
<link rel="stylesheet" type="text/css" href="{{ asset('plugin/simditor/styles/simditor-emoji.css') }}" />

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
    a:hover{
        text-decoration: none;
    }
    a:active{
        text-decoration: none;
    }
</style>
@endpush