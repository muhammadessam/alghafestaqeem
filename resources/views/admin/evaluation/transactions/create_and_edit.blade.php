@extends('admin.layouts.app')
@section('tab_name', __('admin.EvaluationTransactions'))

@section('content')
<style>
    .select2-container--default .select2-selection--single{
      height: 53px !important;
    }
</style>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">@lang('admin.EvaluationTransactions') /
                        @if ($item->id)
                            @lang('admin.Edit') #{{ $item->id }}
                        @else
                            Add
                        @endif
                    </h4>
                    <hr>
                    @if ($item->id)
                        <form id="target" class="needs-validation"
                            action="{{ route('admin.evaluation-transactions.update', $item->id) }}" method="POST"
                            enctype='multipart/form-data' novalidate>
                            <input type="hidden" name="_method" value="PUT">
                        @else
                            <form class="needs-validation" action="{{ route('admin.evaluation-transactions.store') }}"
                                method="POST" enctype='multipart/form-data' novalidate>
                    @endif
                    @csrf

                    <input type="hidden" name="status">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row ">
                                <label for="instrument_number-field" class="col-sm-3 col-form-label">
                                    @lang('admin.instrument_number')
                                    <input class=" " type="button" id="chick" value="معاينة">
                                </label>
                                
                                <div class="col-sm-9 ">
                                    <input required id="instrument_number-field" type="text" class="form-control @if ($errors->has('instrument_number')) is-invalid @endif"
                                    name="instrument_number"
                                    value="{{ $item->instrument_number ?? old('instrument_number') }}" />
                                    <div class="" id="invalid"> </div>

                                    @if ($errors->has('instrument_number'))
                                        <span class="invalid-feedback">{{ $errors->first('instrument_number') }}</span>
                                    @else
                                        <div class="invalid-feedback">إجبارى الأختيار </div>
                                    @endif

                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group row ">
                                <label for="transaction_number-field" class="col-sm-3 col-form-label">
                                    @lang('admin.transaction_number')
                                </label>
                                <div class="col-sm-9 ">
                                    <input required id="transaction_number-field" type="text"
                                        class="form-control @if ($errors->has('transaction_number')) is-invalid @endif"
                                    name="transaction_number"
                                    value="{{ $item->transaction_number ?? old('transaction_number') }}" />
                                    @if ($errors->has('transaction_number'))
                                        <span class="invalid-feedback">{{ $errors->first('transaction_number') }}</span>
                                    @else
                                        <div class="invalid-feedback">إجبارى الأختيار </div>
                                    @endif

                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group row ">
                                <label for="owner_name-field" class="col-sm-3 col-form-label"> @lang('admin.owner_name')
                                </label>
                                <div class="col-sm-9 ">
                                    <input required id="owner_name-field" type="text" class="form-control @if ($errors->has('owner_name')) is-invalid @endif"
                                    name="owner_name"
                                    value="{{ $item->owner_name ?? old('owner_name') }}" />
                                    @if ($errors->has('owner_name'))
                                        <span class="invalid-feedback">{{ $errors->first('owner_name') }}</span>
                                    @else
                                        <div class="invalid-feedback">إجبارى الأختيار </div>
                                    @endif

                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group row ">
                                <label for="region-field" class="col-sm-3 col-form-label"> @lang('admin.region') </label>
                                <div class="col-sm-9 ">
                                    <input required id="region-field" type="text" class="form-control @if ($errors->has('region')) is-invalid @endif"
                                    name="region"
                                    value="{{ $item->region ?? old('region') }}" />
                                    @if ($errors->has('region'))
                                        <span class="invalid-feedback">{{ $errors->first('region') }}</span>
                                    @else
                                        <div class="invalid-feedback">إجبارى الأختيار </div>
                                    @endif

                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group row ">
                                <label for="type_id-field" class="col-sm-3 col-form-label">
                                    @lang('admin.type_id')</label>
                                <div class="col-sm-9 @if ($errors->has('type_id')) is-invalid @endif">
                                    <select required  class="form-control" name="type_id">
                                        <option> </option>
                                        @foreach ($result['types'] as $company)
                                            <option
                                                {{ old('type_id', $item->type_id) == $company->id ? 'selected' : '' }}
                                                value="{{ $company->id }}">
                                                {{ $company->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('type_id'))
                                        <span class="invalid-feedback">{{ $errors->first('type_id') }}</span>
                                         @else
                                        <div class="invalid-feedback">إجبارى الأختيار </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                         <div class="col-md-6">
                            <div class="form-group row ">
                                <label for="city_id-field" class="col-sm-3 col-form-label">
                                    @lang('admin.city_id')</label>
                                <div class="col-sm-9 @if ($errors->has('city_id')) is-invalid @endif">
                                    <select required class="form-control" name="city_id">
                                                                                <option></option>

                                        @foreach ($result['cities'] as $city)
                                            <option
                                                {{ old('city_id', $item->city_id) == $city->id ? 'selected' : '' }}
                                                value="{{ $city->id }}">
                                                {{ $city->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('city_id'))
                                        <span class="invalid-feedback">{{ $errors->first('city_id') }}</span>
                                     @else
                                        <div class="invalid-feedback">إجبارى الأختيار </div>
                                    @endif
                                </div>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group row ">
                                <label for="evaluation_company_id-field" class="col-sm-3 col-form-label">
                                    @lang('admin.evaluation_company_id')</label>
                                <div class="col-sm-9 @if ($errors->has('evaluation_company_id')) is-invalid @endif">
                                     @isset($result['company']) 
                                    @if($result['company']!=null)
                                    <input type="hidden" name="company" value="{{$result['company']->id}}">
                                    @endif
                                    @endisset
                                    <select required  class="form-control js-select2" name="evaluation_company_id">
                                            <option> </option>
                                            @if($result['company']!=null)

                                        <option selected   value="{{ $result['company']->id }}">
                                                {{ $result['company']->title }}  
                                        </option>


                                        @else
                                        @foreach ($result['companies'] as $company)
                                            <option
                                                {{ old('evaluation_company_id', $item->evaluation_company_id) == $company->id ? 'selected' : '' }}
                                                value="{{ $company->id }}">
                                                {{ $company->title }}
                                            </option>
                                        @endforeach
                                        @endif
                                    </select>
                                    @if ($errors->has('evaluation_company_id'))
                                        <span
                                            class="invalid-feedback">{{ $errors->first('evaluation_company_id') }}</span>
                                                 <span class="invalid-feedback">{{ $errors->first('city_id') }}</span>
                                     @else
                                        <div class="invalid-feedback">إجبارى الأختيار </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group row ">
                                <label for="evaluation_employee_id-field" class="col-sm-3 col-form-label">
                                    @lang('admin.evaluation_employee_id')</label>
                                <div class="col-sm-9 @if ($errors->has('evaluation_employee_id')) is-invalid @endif">
                                    <select class="form-control js-select2" name="evaluation_employee_id">
                                        <option value="">@lang('admin.No_employee')</option>
                                        @foreach ($result['employees'] as $employee)
                                            <option
                                                {{ old('evaluation_employee_id', $item->evaluation_employee_id) == $employee->id ? 'selected' : '' }}
                                                value="{{ $employee->id }}">
                                                {{ $employee->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('evaluation_employee_id'))
                                        <span
                                            class="invalid-feedback">{{ $errors->first('evaluation_employee_id') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group row ">
                                <label for="date-field" class="col-sm-3 col-form-label"> @lang('admin.date')
                                </label>
                                <div class="col-sm-9 ">
                                    <input required id="date-field" type="date" class="form-control @if ($errors->has('date')) is-invalid @endif"
                                    name="date"
                                    value="{{ $item->date ?? old('date') }}" />
                                    @if ($errors->has('date'))
                                        <span class="invalid-feedback">{{ $errors->first('date') }}</span>
                                    @else
                                        <div class="invalid-feedback">إجبارى الأختيار </div>
                                    @endif

                                </div>
                            </div>
                        </div>



                        <div class="col-md-6">
                            <div class="form-group row ">
                                <label for="previewer-field" class="col-sm-3 col-form-label"> @lang('admin.previewer')
                                </label>
                                <div class="col-sm-9 @if ($errors->has('previewer_id')) is-invalid @endif">
                                    <select class="form-control js-select2" name="previewer_id">
                                    <option value="">@lang('admin.No_employee')</option>

                                        @foreach ($result['employees'] as $employee)
                                            <option
                                                {{ old('previewer_id', $item->previewer_id) == $employee->id ? 'selected' : '' }}
                                                value="{{ $employee->id }}">
                                                {{ $employee->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('previewer_id'))
                                        <span class="invalid-feedback">{{ $errors->first('previewer_id') }}</span>
                                    @endif
                                </div>

                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group row ">
                                <label for="review-field" class="col-sm-3 col-form-label"> @lang('admin.review')
                                </label>

                                <div class="col-sm-9 @if ($errors->has('review_id')) is-invalid @endif">
                                    <select class="form-control js-select2" name="review_id">
                                    <option value="">@lang('admin.No_employee')</option>

                                        @foreach ($result['employees'] as $employee)
                                            <option
                                                {{ old('review_id', $item->review_id) == $employee->id ? 'selected' : '' }}
                                                value="{{ $employee->id }}">
                                                {{ $employee->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('review_id'))
                                        <span class="invalid-feedback">{{ $errors->first('review_id') }}</span>
                                    @endif
                                </div>

                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group row ">
                                <label for="income-field" class="col-sm-3 col-form-label"> @lang('admin.income')
                                </label>
                                <div class="col-sm-9 @if ($errors->has('income_id')) is-invalid @endif">
                                    <select class="form-control js-select2" name="income_id">
                                    <option value="">@lang('admin.No_employee')</option>

                                        @foreach ($result['employees'] as $employee)
                                            <option
                                                {{ old('income_id', $item->income_id) == $employee->id ? 'selected' : '' }}
                                                value="{{ $employee->id }}">
                                                {{ $employee->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('income_id'))
                                        <span class="invalid-feedback">{{ $errors->first('income_id') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>


                        <div class="col-md-12"></div>

                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="notes-field">@lang('admin.Notes')</label>
                                <div class="col-sm-9 @if ($errors->has('notes')) is-invalid @endif">

                                    <textarea class="form-control @if ($errors->has('notes')) is-invalid @endif"
                                           name="notes" rows="10">{{ old('notes', $item->notes) ?? '' }}</textarea>
                                    @if ($errors->has('notes'))
                                        <span class="invalid-feedback">{{ $errors->first('notes') }}</span>
                                    @endif
                                </div>

                            </div>
                        </div>
                        
                          <!--  -->
                        <div class="col-md-6">
                            <div class="form-group row ">
                                <label for="company_fundoms-field" class="col-sm-3 col-form-label"> @lang('admin.company_fundoms') </label>
                                <div class="col-sm-9 ">
                                    <input  id="company_fundoms-field" type="number" class="form-control @if ($errors->has('company_fundoms')) is-invalid @endif"
                                    name="company_fundoms"
                                    value="{{ $item->company_fundoms ?? old('company_fundoms') }}" />
                                    @if ($errors->has('company_fundoms'))
                                        <span class="invalid-feedback">{{ $errors->first('company_fundoms') }}</span>
                                    @else
                                    <div class="invalid-feedback">إجبارى الأختيار </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row ">
                                <label for="review_fundoms-field" class="col-sm-3 col-form-label"> @lang('admin.review_fundoms') </label>
                                <div class="col-sm-9 ">
                                    <input  id="review_fundoms-field" type="number" class="form-control @if ($errors->has('review_fundoms')) is-invalid @endif"
                                    name="review_fundoms"
                                    value="{{ $item->review_fundoms ?? old('review_fundoms') }}" />
                                    @if ($errors->has('review_fundoms'))
                                        <span class="invalid-feedback">{{ $errors->first('review_fundoms') }}</span>
                                   
                                    @endif

                                </div>
                            </div>
                        </div>

                        <!--  -->
                        
                         <div class="col-md-6">
                            <div class="form-group row ">
                                <label for="phone-field" class="col-sm-3 col-form-label"> @lang('admin.phone') </label>
                                <div class="col-sm-9 ">
                                    <input  required id="phone-field" type="tel" class="form-control @if ($errors->has('phone')) is-invalid @endif"
                                    name="phone"
                                    value="{{ $item->phone ?? old('phone') }}" />
                                    @if ($errors->has('phone'))
                                        <span class="invalid-feedback">{{ $errors->first('phone') }}</span>
                                             <span class="invalid-feedback">{{ $errors->first('city_id') }}</span>
                                     @else
                                        <div class="invalid-feedback">إجبارى الأختيار </div>
                                    @endif
                                   

                                </div>
                            </div>
                        </div>
                         <div class="col-md-6">
                            <div class="form-group row ">
                                <label for="files-field" class="col-sm-3 col-form-label"> @lang('admin.files') </label>
                                <div class="col-sm-9 ">
                                    <input multiple   id="files-field" type="file"   class="form-control @if ($errors->has('files')) is-invalid @endif"
                                    name="files[]"
                                    value="{{ $item->files ?? old('files') }}" />
                                    @if ($errors->has('files'))
                                        <span class="invalid-feedback">{{ $errors->first('files') }}</span>
                                        @else
                                       <span class="invalid-feedback">إجبارى الأختيار</span>

                                   
                                    @endif

                                </div>
                                 @foreach($item->files as $file)
                                        <span>{{$file->path}}</span>
                                        <td style="display:block" class="text-left"> <a  href="{{url('admin/evaluation-transactions/Delete/File/'.$file->id.'')}}"  rel="noopener noreferrer">  حذف</a> </td>
                                 @endforeach
                            </div>
                        </div>

                        <div class="col-md-12">
                            <hr>
                            <button id="save" type="submit" name="action" value="save"
                                class="btn btn-primary">@lang('admin.Save')</button>

                            <a class="btn btn-danger pull-right text-white"
                                href="{{ route('admin.evaluation-transactions.index') }}">
                                @lang('admin.Cancel')<i class="mdi mdi-arrow-left-bold"></i></a>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script src="{{ asset('/panel/js/upload.js') }}"></script>
    <script src="{{ asset('/panel/js/validate.js') }}"></script>
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
 <script>
     $(document).ready(function() {
     $('#save').click(function(e) {
          $( "#target" ).trigger( "submit" );
 
        // $('#save').prop('disabled', true);
   
  });
  
  
});
 </script>
 <script type="text/javascript">
        $('#chick').click(function(e) {
            $('#invalid').text("");
           var value= $('#instrument_number-field').val();
           if(value.length >0)
           {
           var url = "/admin/chick_instrument_number/"+value;      
            $.ajax({
                    type:'get',
                    url: url,
                    contentType: false,
                    processData: false,
                    success: (response) => {
                        $('#invalid').append(response);
                    }
                    
               });
            }
          
           
           
        });
        // $('#instrument_number-field').keydown(function(e) {
        //     $('#invalid').text("");
        //    var value= $('#instrument_number-field').val();
        //    if(value.length >0)
        //    {
        //    var url = "/admin/chick_instrument_number/"+value;      
        //     $.ajax({
        //             type:'get',
        //             url: url,
        //             contentType: false,
        //             processData: false,
        //             success: (response) => {
        //                 $('#invalid').text(response);
        //             }
                    
        //        });
        //     }
          
           
           
        // });
        
    </script>

 
 <link rel="stylesheet" href=" https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
@endsection
 
