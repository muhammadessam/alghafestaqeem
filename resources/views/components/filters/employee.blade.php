@php use Illuminate\Database\Eloquent\Builder; @endphp
<div>
    @if(isset($filters['select']['evaluation_employee_id']))
        @php
            $emp = $filters['select']['evaluation_employee_id'];
            $previewer = $new_data->where('previewer_id', $emp)->count();
            $review = $new_data->where('review_id', $emp)->count();
            $income = $new_data->where('income_id', $emp)->count();
        @endphp
        <div class="bg-white mx-5 mt-2 flex">
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
    @endif
</div>
