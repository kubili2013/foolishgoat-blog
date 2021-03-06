@extends('layouts.app')

@section('content')
    <div class="text-center" style="background-image:url('imgs/2.jpg');background-size:100%;padding-bottom:24px;padding-top:82px;margin-bottom:24px;">
        <h2 style="color:#eee;">{{__('Share List')}}</h2>
    </div>
    <div class="container">
        <div class="row">


            <div class="col-lg-8 col-md-8 col-sm-12">
                <div class="panel panel-default text-center" style="margin-bottom:24px;border:1px solid #ddd;padding:12px 15px;">
                    <a href="#" data-toggle="modal" data-target="#create-share-modal" style="font-size:24px;text-align: center;">
                        <i class="fa fa-plus" ></i>
                    </a>
                </div>
                @if($shares->isEmpty())
                    <div class="panel panel-default" style="margin-bottom:24px;border:1px solid #ddd;padding:24px 16px;">
                        <div class="row">
                            <div class="col-lg-12 text-center">
                                <h3>{{__('Sorry!Have no Shares!')}}</h3>
                            </div>
                        </div>
                    </div>
                @endif
                @foreach($shares as $share)
                    <div class="panel panel-default" style="margin-bottom:24px;border:1px solid #ddd;padding:16px 24px;">
                        <div class="row">
                            <div class="col-lg-12">
                                <h5 class="title">{{$share->title}}</h5>
                                <hr/>
                                @if($share->type == 'audio')
                                    <audio src="{{$share->content}}"></audio>
                                @elseif($share->type == 'video')
                                    <video src="{{$share->content}}" style="width:100%"></video>
                                @elseif($share->type == 'article')
                                    <p>{{$share->content}}</p>
                                @elseif($share->type == 'website')
                                    <h5><a href="{{$share->content}}" target="_black">{{$share->content}}</a></h5>
                                @endif
                                <p>
                                    @foreach($share->list_tags() as $tags)
                                        <span class="badge"  style="background:#f96332;color:#fff;">{{ $tags }}</span>&nbsp;
                                    @endforeach
                                </p>
                            </div>
                        </div>
                        <div class="panel-footer operate">
                            <div class="row">
                                <div class="col-lg-6">
                                        <span rel="tooltip" title="{{__('Author')}}" data-placement="bottom">
                                            <i class="fa fa-user" style="color:#f96332" ></i>&nbsp;<span>{{$share->user->name}}</span>
                                        </span> &nbsp;⋅&nbsp;
                                    <span rel="tooltip" title="{{$share->created_at}}" data-placement="bottom">
                                            <i class="fa fa-calendar-o"  style="color:#f96332"></i>&nbsp;<span class="time_enhance">{{__('Created at')}}{{$share->created_at->diffForHumans()}}</span>
                                        </span>
                                </div>
                                <div class="col-lg-6 text-right" style="color:#333;">
                                    @if(Auth::check() && $share->user->id == Auth::user()->id)

                                        {{--<a href="{{route('share.edit',['share'=>$share->id])}}" rel="tooltip" title="{{__('Edit')}}" data-placement="bottom" >--}}
                                            {{--<i class="fa fa-cog" ></i>--}}
                                        {{--</a>&nbsp;--}}
                                        <a href="#" rel="tooltip" title="{{__('Delete')}}" data-placement="bottom" onclick="deleteCheck('{{route('share.trash',['share'=>$share->id])}}');" >
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
                {{ $shares -> links("layouts.components.my_pagination") }}
            </div>

            <div class="col-lg-4 col-md-4 col-sm-12">
                @if(auth()->check())
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
                @endif
            </div>

        </div>

    </div>

    <div class="modal fade" id="create-share-modal" tabindex="-1" role="dialog" aria-labelledby="create-share-modal-label">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                {!! Form::open(['route' => 'share.store']) !!}
                {!! Form::token() !!}
                <div class="modal-header justify-content-center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="title title-up" id="create-share-modal-label">{{__("Add Share")}}</h4>
                </div>
                <div class="modal-body">

                    <div class="form-group {{$errors->has('title')?" has-error":""}}">
                        {!! Form::label('title', __('Title')  . ($errors->has('title')? " (" . $errors->first('title'). ") :" : ":"), ['class' => 'control-label ' ]) !!}
                        {!! Form::text('title',old('title'),['class'=>'form-control','placeholder'=> __('Article Title')]) !!}
                    </div>
                    <div class="form-group {{$errors->has('tags')?" has-error":""}}">
                        {!! Form::label('tags', __('Tags') . ($errors->has('tags')? " (" . $errors->first('tags'). ") :" :":"), ['class' => 'control-label ']) !!}
                        {!! Form::text('tags',old('tags'),['class'=>'form-control','placeholder'=> __('Tags')]) !!}
                    </div>
                    <div class="form-group {{$errors->has('type')?" has-error":""}}">
                        {!! Form::label('type', __('Type') . ($errors->has('type')? " (" . $errors->first('tags'). ") :" :":"), ['class' => 'control-label ']) !!}
                        {!! Form::select('type', ['website' => __('Website'),'video' => __('Video'), 'audio' => __('Audio'),'article' => __('Article')], old('type'), ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group {{$errors->has('content')?" has-error":""}}">
                        {!! Form::label('content', __('Content')  . ($errors->has('content')? " (" . $errors->first('content'). ") :" : ":"), ['class' => 'control-label ' ]) !!}
                        {!! Form::text('content',old('content'),['class'=>'form-control','placeholder'=> __('Content')]) !!}
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
<script type="text/javascript">
    $(function(){
        @if($errors->has('title') || $errors->has('tags') || $errors->has('content') || $errors->has('type'))
            $('#create-share-modal').modal('show');
        @endif
    });
</script>
@endpush