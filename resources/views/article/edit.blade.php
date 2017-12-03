@extends('layouts.app')

@section('content')

    <div class="container" style="padding-top:62px;">

        <div class="panel panel-default" style="margin-top:24px;margin-bottom: 24px;border:1px solid #ddd;padding:24px 15px;">
            <div class="row justify-content-md-center">
                <div class="col-lg-10">
                    <h1>{{ __('Edit Article') }}</h1>
                    {!! Form::open(['route' => ['article.update',$article->id],'method'=>'PUT']) !!}
                    {!! Form::token() !!}
                    {!! Form::hidden('id',$article->id) !!}
                    <div class="form-group {{$errors->has('thumbnail')?" has-error":""}}">
                        {!! Form::label('thumbnail', __('Article Thumbnail') . ($errors->has('thumbnail')? " (" . $errors->first('thumbnail'). ") :" :":"), ['class' => 'control-label ']) !!}
                        {!! Form::text('thumbnail',$article->thumbnail,['class'=>'form-control','placeholder'=> __('Article Thumbnail') . '  http://foolishgoat.com/0001.jpg']) !!}
                    </div>
                    <div class="form-group {{$errors->has('title')?" has-error":""}}">
                        {!! Form::label('title', __('Article Title')  . ($errors->has('title')? " (" . $errors->first('title'). ") :" : ":"), ['class' => 'control-label ' ]) !!}
                        {!! Form::text('title',$article->title,['class'=>'form-control','placeholder'=> __('Article Title')]) !!}
                    </div>
                    <div class="form-group  {{$errors->has('tags')?" has-error":""}}">
                        {!! Form::label('tags', __('Article Tags')  . ($errors->has('tags')? " (" .$errors->first('tags'). ") :" :":"), ['class' => 'control-label']) !!}
                        <blockquote>
                            <div class="blockquote blockquote-primary">
                                <div class="row">
                                @foreach($tags as $tag)
                                    <div class="checkbox col-lg-3 col-md-4 col-sm-6" style="display: inline-block;">
                                        {!! Form::checkbox("tags[]", $tag->id, $article->tags->where('id', $tag->id)->isNotEmpty(),['id' => "tags".$tag->id]) !!}
                                        <label for="tags{{$tag->id}}">{{ $tag->tags }}</label>
                                    </div>
                                @endforeach
                                </div>
                            </div>
                        </blockquote>
                    </div>

                    <div class="form-group {{$errors->has('content')?" has-error":""}}" style="padding:0px;">
                        {!! Form::label('content', __('Article Content') . ($errors->has('content')? " (" . $errors->first('content'). ") :" : ":"), ['class' => 'control-label']) !!}
                        <div class="editor">
                            {!! Form::textarea('content',$article->content->content,['class'=>'form-control','rows'=>'20','id'=>'myEditor','placeholder'=> __('Article Content'),"autofocus"=>""]) !!}
                        </div>
                    </div>
                    <div class="form-group text-right">
                        {!! Form::hidden('publish',0) !!}
                        {!! Form::submit(__('Release'),['class' => 'btn btn-default btn-round','onclick'=>'$("input[name=publish]").val(1);']) !!}
                        {!! Form::submit(__('Save'),['class' => 'btn btn-primary btn-round']) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

    </div>
@endsection
{{-- 引入编辑器所用css --}}
@push('css')
    <link rel="stylesheet" type="text/css" href="//cdn.staticfile.org/simditor/2.3.6/styles/simditor.min.css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('plugin/simditor/styles/simditor-emoji.css') }}" />
@endpush
{{-- 引入编辑器所用js --}}
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
        upload: location.search === '?upload' ? {
            url: '/upload'
        } : false
    });
</script>
@endpush

@push("nav-class")
class="navbar navbar-expand-lg bg-primary fixed-top"
@endpush