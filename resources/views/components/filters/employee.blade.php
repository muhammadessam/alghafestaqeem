@php use Illuminate\Database\Eloquent\Builder; @endphp
<div>
    @if(isset($filters['select']['evaluation_employee_id']))
        @php
            $emp = $filters['select']['evaluation_employee_id'];
            if (isset($company)){
                $items = \App\Models\Evaluation\EvaluationTransaction::where('evaluation_company_id', $company)->where(function (Builder $query) use($emp){
                    $query->where('previewer_id', $emp)->orWhere('income_id', $emp)->orWhere('review_id', $emp);
                })->get();
            }else{
                $items = \App\Models\Evaluation\EvaluationTransaction::where('previewer_id', $emp)->orWhere('income_id', $emp)->orWhere('review_id', $emp)->get();
            }
            $previewer = $items->where('previewer_id', $emp)->count();
            $review = $items->where('review_id', $emp)->count();
            $income = $items->where('income_id', $emp)->count();

        @endphp
        <div class="bg-white mx-5 mt-2 flex">
            <div class="flex items-center  text-danger">
                <h5 class="p-3 font-bold">عدد المعاملات : </h5>
                <span>{{$items->count()}}</span>
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
