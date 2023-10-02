@extends('admin.layouts.app')
@section('tab_name', __('admin.EvaluationTransactions'))
@section('css')
    <style>
        .table td img,
        .jsgrid .jsgrid-table td img {
            width: 200px;
            height: 200px;
            border-radius: 100%;
        }

    </style>
@endsection
 

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card px-2">
                <div class="card-body">
                    <div class="container-fluid">
                        <h3 class="text-right my-5">
                            @lang('admin.EvaluationTransactionNo')&nbsp;&nbsp;#RR-{{ $item->id }}
                            {{-- <a href="#" class="btn btn-primary float-left"><i
                                    class="ti-printer me-1"></i>@lang('admin.Print')</a> --}}
                        </h3>

                        <hr>
                    </div>
                    <div class="container-fluid d-flex justify-content-between">
                        <div class="col-lg-3 ps-0">
                            <p class="mt-5 mb-2"><b>@lang('admin.Employee')</b></p>
                            <p>@lang('admin.Name'): {{ $item->employee->title ?? '' }}</p>
                            <p>@lang('admin.price'): {{ $item->employee->price ?? '' }}</p>

                            <p class="mt-5 mb-2"><b>@lang('admin.Company')</b></p>
                            <p>@lang('admin.Name'): {{ $item->company->title }}</p>


                        </div>
                        <div class="col-lg-3 pr-0">
                            <p class="mt-5 mb-2 text-right"><b>@lang('admin.TransactionDetail')</b></p>

                            <p class="text-right">@lang('admin.instrument_number') : {{ $item->instrument_number }}<br>
                                @lang('admin.iterated') :{!! $item->iterated_span !!}</p>
                            <p class="text-right">@lang('admin.transaction_number') : {{ $item->transaction_number }}</p>
                            <p class="mb-0 mt-1">@lang('admin.CreationDate') :
                                {{ \App\Helpers\ArabicDate::format($item->created_at, 'd M Y') }}</p>
                            <p>@lang('admin.LastUpdate') :
                                {{ \App\Helpers\ArabicDate::format($item->updated_at, 'd M Y') }}</p>
                        </div>
                    </div>

                    <div class="container-fluid mt-5 d-flex justify-content-center w-100">
                        <div class="table-responsive w-100">
                            <table class="table" >
                                <thead>
                                    <tr class="bg-dark text-white">

                                        <th>@lang('admin.Title')</th>
                                        <th class="text-right">@lang('admin.Description')</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-dark text-left ">@lang('admin.type_id')</td>
                                        <td class="text-left">{{ $item->type ? $item->type->title : '' }} </td>
                                    </tr>

                                    <tr>
                                        <td class="text-dark text-left ">@lang('admin.owner_name')
                                        </td>
                                        <td class="text-left">{!! $item->owner_name !!} </td>
                                    </tr>
                                    <tr>
                                        <td class="text-dark text-left ">@lang('admin.region')
                                        </td>
                                        <td class="text-left"> {!! $item->region !!} </td>
                                    </tr>

                                    <tr>
                                        <td class="text-dark text-left ">@lang('admin.date')
                                        </td>
                                        <td class="text-left"> {!! $item->date !!} </td>
                                    </tr>


                                    <tr>
                                        <td class="text-dark text-left ">@lang('admin.income')
                                        </td>
                                        <td class="text-left"> {{ $item->income ? $item->income->title : '' }} </td>
                                    </tr>

                                    <tr>
                                        <td class="text-dark text-left ">@lang('admin.previewer')
                                        </td>
                                        <td class="text-left"> {{ $item->previewer ? $item->previewer->title : '' }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="text-dark text-left ">@lang('admin.review')
                                        </td>
                                        <td class="text-left"> {{ $item->review ? $item->review->title : '' }} </td>
                                    </tr>
                                      <tr>
                                        <td class="text-dark text-left ">@lang('admin.company_fundoms')
                                        </td>
                                        <td class="text-left"> {{ $item->company_fundoms  }} </td>
                                    </tr><tr>
                                        <td class="text-dark text-left ">@lang('admin.review_fundoms')
                                        </td>
                                        <td class="text-left"> {{ $item->review_fundoms  }} </td>
                                    </tr>


                                    <tr>
                                        <td class="text-dark text-left ">@lang('admin.notes')
                                        </td>
                                        <td class="text-left"> {!! $item->notes !!} </td>
                                    </tr>
                                     <tr>
                                    <td class="text-dark text-left ">@lang('admin.files')
                                        </td>
                                        @foreach($item->files as $file)
                                        <span>{{$file->path}}</span>
                                        <td style="display:block" class="text-left"> 
                                        <a  href="{{url('public/upload/transaction/'.$file->path.'')}}" target="_blank" rel="noopener noreferrer"> {{$file->path}}  download </a> 
                                       </td>
                                        @endforeach
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- <div class="container-fluid w-100">
                        <a href="#" class="btn btn-primary float-right mt-4 ms-2"><i
                                class="ti-printer me-1"></i>@lang('admin.Print')</a>
                         <a href="#" class="btn btn-success float-right mt-4"><i class="ti-export me-1"></i>Send Invoice</a>
                        </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
