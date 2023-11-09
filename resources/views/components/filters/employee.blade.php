<div class="w-full bg-white p-3 grid grid-cols-4 gap-x-2 gap-y-3 mt-3">
    <x-input wire:model.live="my_filters.transaction_number" :label="trans('admin.transaction_number')"/>
    <x-select
        label="{{trans('admin.employee')}}"
        placeholder="{{trans('admin.employee')}}"
        :options="\App\Models\Evaluation\EvaluationEmployee::all()"
        option-label="title"
        option-value="id"
        wire:model.live="my_filters.employee_id"
        :clearable="true"
    />
    @if(!isset($company))
        <x-select
            label="{{trans('admin.company')}}"
            placeholder="{{trans('admin.company')}}"
            :options="\App\Models\Evaluation\EvaluationCompany::all()"
            option-label="title"
            option-value="id"
            wire:model.live="my_filters.company_id"
            :clearable="true"
            :multiselect="true"
        />
    @endif
    <x-select
        label="{{trans('admin.Status')}}"
        placeholder="{{trans('admin.Status')}}"
        :options="[
                ['id' => 0, 'name' => trans('admin.NewTransaction')],
                ['id' => 1, 'name' => trans('admin.InReviewRequest')],
                ['id' => 2, 'name' => trans('admin.ContactedRequest')],
                ['id' => 3, 'name' => trans('admin.ReviewedRequest')],
                ['id' => 4, 'name' => trans('admin.FinishedRequest')],
                ['id' => 5, 'name' => trans('admin.PendingRequest')],
                ['id' => 6, 'name' => trans('admin.Cancelled')],
            ]"
        option-label="name"
        option-value="id"
        wire:model.live="my_filters.status"
        :clearable="true"
    />
    <x-select
        label="{{trans('admin.city_id')}}"
        placeholder="{{trans('admin.city')}}"
        :options="\App\Models\Category::where('type', \App\Helpers\Constants::CityType)->select(['id', 'title'])->get()->toArray()"
        option-label="title"
        option-value="id"
        wire:model.live="my_filters.city_id"
        :clearable="true"
    />
    @if(!$is_daily)
        <x-datetime-picker
            :label="trans('admin.LastUpdate'). ' من'"
            :without-time="true"
            wire:model.live="my_filters.from_date"
            dir="ltr"
            display-format="YYYY-MM-DD"
        />
        <x-datetime-picker
            :label="trans('admin.LastUpdate'). ' الي'"
            :without-time="true"
            wire:model.live="my_filters.to_date"
            dir="ltr"
            display-format="YYYY-MM-DD"
        />
    @endif

    @if(isset($my_filters['employee_id']))
        @php
            $emp = $my_filters['employee_id'];
            $previewer = $new_data->where('previewer_id', $emp)->count();
            $review = $new_data->where('review_id', $emp)->count();
            $income = $new_data->where('income_id', $emp)->count();
        @endphp
        <div class="bg-white mx-5 mt-2 col-span-4 flex w-full">
            <div class="flex items-center  text-danger">
                <h5 class="p-3 font-bold">عدد المعاملات : </h5>
                <span>{{$previewer + 0.5*($review + $income)}}</span>
            </div>
            <div class="flex items-center  text-danger">
                <h5 class="p-3 font-bold">عدد المعاينات : </h5>
                <span>{{$previewer}}</span>
            </div>
            <div class="flex items-center  text-danger">
                <h5 class="p-3 font-bold">عدد الادخال : </h5>
                <span>{{$income *0.5}}</span>
            </div>
            <div class="flex items-center  text-danger">
                <h5 class="p-3 font-bold">عدد المراجعات : </h5>
                <span>{{$review*0.5}}</span>
            </div>
        </div>
    @else
        <div class="w-full bg-white mt-2 col-span-4">
            <div class="flex items-center  text-danger">
                <h5 class="font-bold">عدد المعاملات : </h5>
                <span>{{$data->total()}}</span>
            </div>
        </div>
    @endif

</div>
