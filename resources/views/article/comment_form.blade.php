{!! Form::open(['route' => 'comment.store']) !!}
{!! Form::token() !!}
<div class="form-group {{$errors->has('content')?" has-error":""}}" style="padding:0px;">
    {!! Form::label('body', __('Comment') . ($errors->has('body')? " (" . $errors->first('body'). ") :" : ":"), ['class' => 'control-label']) !!}
    {!! Form::hidden('commentable_id',$article->id) !!}
    {!! Form::hidden('commentable_type',"app\\Article") !!}
    <div class="editor">
        {!! Form::textarea('body',old('body'),['class'=>'form-control','id'=>'myEditor','placeholder'=> __('Comment Content'),"autofocus"=>""]) !!}
    </div>
</div>
<div class="form-group text-right" style="margin-bottom: 0px;">
    {!! Form::submit(__('Submit'),['class' => 'btn btn-primary btn-round']) !!}
</div>
{!! Form::close() !!}


@push('css')
<link rel="stylesheet" type="text/css" href="//cdn.staticfile.org/simditor/2.3.6/styles/simditor.min.css" />
<link rel="stylesheet" type="text/css" href="{{ asset('plugin/simditor/styles/simditor-emoji.css') }}" />
<style>
    .simditor .simditor-body{
        min-height:100px;
    }
</style>
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
        toolbar:['ol', 'ul', 'blockquote', 'code', 'table', '|', 'link', 'image', 'hr', '|', 'indent', 'outdent', 'alignment','|','emoji'],
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