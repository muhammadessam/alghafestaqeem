<div class="flex flex-col gap-y-2">
    <div class="flex">
        <div class="font-bold ml-2">{{trans('admin.type_id')}}:</div>
        <div>{{$model->type->title ?? ''}}</div>
    </div>
    <div class="flex">
        <div class="font-bold ml-2">{{trans('admin.owner_name')}}:</div>
        <div>{{$model->owner_name}}</div>
    </div>
    <div class="flex">
        <div class="font-bold ml-2">{{trans('admin.city_id')}}:</div>
        <div>{{$model->city->title ?? ''}}</div>
    </div>
    <div class="flex">
        <div class="font-bold ml-2">{{trans('admin.review')}}:</div>
        <div>{{$model->review->title ?? ''}}</div>
    </div>
    <div class="flex">
        <div class="font-bold ml-2">{{trans('admin.income')}}:</div>
        <div>{{$model->income->title ?? ''}}</div>
    </div>
</div>
