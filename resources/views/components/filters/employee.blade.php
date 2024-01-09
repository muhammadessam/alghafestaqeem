<div class="w-full bg-white p-3 grid grid-cols-1 gap-x-2 gap-y-3 mt-3">
    <div class="row w-full">
        <div class="col">
            {{$this->form}}
        </div>
    </div>

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
