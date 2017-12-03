{{-- 新增选择类型对话框 start --}}
<div class="modal fade show" id="choose_type" tabindex="-1" role="dialog" aria-labelledby="choose_typeLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header justify-content-center">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <i class="now-ui-icons ui-1_simple-remove"></i>
                </button>
                <h4 class="title title-up">{{__('Choose & Add')}}</h4>
            </div>
            <div class="modal-body text-center">
                <a href="{{route('article.create')}}"
                        class="btn btn-primary btn-tooltip"
                        data-toggle="tooltip"
                        data-placement="bottom"
                        title=""
                        data-container="body"
                        data-animation="true"
                        data-original-title="{{__('Add')}} {{__('Article')}}"><i class="fa fa-edit"></i></a>
                <button type="button"
                        class="btn btn-primary btn-tooltip"
                        data-toggle="tooltip"
                        data-placement="bottom"
                        title=""
                        data-container="body"
                        data-animation="true"
                        data-original-title="{{__('Add')}} {{__('Share')}}"><i class="fa fa-share-alt"></i></button>

                <button type="button"
                        class="btn btn-primary btn-tooltip"
                        data-toggle="tooltip"
                        data-placement="bottom"
                        title=""
                        data-container="body"
                        data-animation="true"
                        data-original-title="{{__('Add')}} {{__('Diary')}}"><i class="fa fa-calendar-o"></i></button>

                <button type="button"
                        class="btn btn-primary btn-tooltip"
                        data-toggle="tooltip"
                        data-placement="bottom"
                        title=""
                        data-container="body"
                        data-animation="true"
                        data-original-title="{{__('Add')}} {{__('Picture')}}"><i class="fa fa-camera"></i></button>

                <button type="button"
                        class="btn btn-primary btn-tooltip"
                        data-toggle="tooltip"
                        data-placement="bottom"
                        title=""
                        data-container="body"
                        data-animation="true"
                        data-original-title="{{__('Add')}} {{__('Collection')}}"><i class="fa fa-heart"></i></button>

            </div>
            {{--<div class="modal-footer">--}}
            {{--<button type="button" class="btn btn-default">Nice Button</button>--}}
            {{--<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>--}}
            {{--</div>--}}
        </div>
    </div>
</div>
{{-- 新增选择类型对话框 end--}}