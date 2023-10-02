<style>
    .select2-container--default .select2-selection--single{
      height: 53px !important;
    }
</style>
<form action="{{ url('admin/Review-transactions') }}" method="GET">
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12 form-group">
            <input type="text" value="{{ app('request')->input('search') ?? '' }}" name="search" class="form-control"
                placeholder="@lang('admin.SearchNow')" />
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12 form-group">
            <select class="  form-control js-select2" name="employee">
                <option value="">@lang('admin.employee')</option>
                @if (!empty($result['employees']))
                    @foreach ($result['employees'] as $employee)
                        <option {{ app('request')->input('employee') == $employee->id ? 'selected' : '' }}
                            value="{{ $employee->id }}">
                            {{ $employee->title }}
                        </option>
                    @endforeach
                @endif
            </select>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12 form-group">
            <select multiple class="form-control js-select2" name="company[]">
                <option value="">@lang('admin.company')</option>
                @if (!empty($result['companies']))
                    @foreach ($result['companies'] as $company)
                        <option {{ app('request')->input('company') == $company->id ? 'selected' : '' }}
                            value="{{ $company->id }}">
                            {{ $company->title }}
                        </option>
                    @endforeach
                @endif
            </select>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12 form-group">
            <select class="form-control js-select2" name="status">
                <option value="" selected>كل الحالات</option>
                @foreach ($result['statuses'] as $status)
                    <option
                        {{ !empty(app('request')->input('status')) && app('request')->input('status') == $status['id'] ? 'selected' : '' }}
                        value="{{ $status['id'] }}">
                        {{ __('admin.' . $status['title']) }}
                    </option>
                @endforeach
            </select>
        </div>
        
        
        <div class="col-md-3 col-sm-6 col-xs-12 form-group">
            <select class="form-control js-select2" name="city">
                <option value="">@lang('admin.city')</option>
                @if (!empty($result['cities']))
                    @foreach ($result['cities'] as $city)
                        <option {{ app('request')->input('city') == $city->id ? 'selected' : '' }}
                            value="{{ $city->id }}">
                            {{ $city->title }}
                        </option>
                    @endforeach
                @endif
            </select>
        </div>
        


        <div class="col-md-3 col-sm-6 col-xs-12 form-group">
            <input type="date" value="{{ app('request')->input('from_date') ?? '' }}" name="from_date"
                class="form-control" format="YYYY-MM-DD" />
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12 form-group">
            <input type="date" value="{{ app('request')->input('to_date') ?? '' }}" name="to_date"
                class="form-control" format="YYYY-MM-DD" />
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12 form-group ">
            <button type="submit" class="btn btn-primary btn-block" style="    width: 100%;height: 53px">@lang('admin.Search')</button>
        </div>
    </div>
</form>
 
@section('scripts')
 
    
    
 
 
 <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
 <script>
     $(document).ready(function() {
  $(".js-select2").select2({
    closeOnSelect: false
  });
  $(".js-select2-multi").select2({
    closeOnSelect: false
  });
});
 </script>
 
 <link rel="stylesheet" href=" https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
@endsection

