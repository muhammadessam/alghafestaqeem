<div class="w-full bg-white p-5 grid grid-cols-4 gap-x-2 gap-y-3 mt-3">
    <x-select
        label="{{trans('admin.employee')}}"
        placeholder="{{trans('admin.evaluation_employee_id')}}"
        :options="\App\Models\Evaluation\EvaluationEmployee::all()"
        option-label="title"
        option-value="id"
        wire:model.live="my_filters.employee_id"
        :clearable="true"
    />
    <x-select
        label="{{trans('admin.company')}}"
        placeholder="{{trans('admin.company')}}"
        :options="\App\Models\Evaluation\EvaluationCompany::all()"
        option-label="title"
        option-value="id"
        wire:model="my_filters.company_id"
        :clearable="true"
    />
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
    <x-datetime-picker
        :label="trans('admin.LastUpdate'). ' من'"
        :without-time="true"
        wire:model="my_filters.from_date"
        dir="ltr"
    />
    <x-datetime-picker
        :label="trans('admin.LastUpdate'). ' الي'"
        :without-time="true"
        wire:model.live="my_filters.to_date"
        dir="ltr"
    />
</div>
