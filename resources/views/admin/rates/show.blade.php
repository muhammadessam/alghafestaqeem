@extends('admin.layouts.app')
@section('tab_name', __('admin.Rates'))
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
                        <h3 class="text-right my-5">@lang('admin.RatesNo')&nbsp;&nbsp;#RR-{{ $item->id }}
                            {{-- <a href="#" class="btn btn-primary float-left"><i
                                    class="ti-printer me-1"></i>@lang('admin.Print')</a> --}}
                        </h3>

                        <hr>
                    </div>
                    <div class="container-fluid d-flex justify-content-between">
                        <div class="col-lg-3 ps-0">
                            <p class="mt-5 mb-2"><b>@lang('admin.Customer')</b></p>
                            <p>@lang('admin.Name'): {{ $item->name }}</p>
                            <p>@lang('admin.E-mail'): {{ $item->email }}</p>
                            <p>@lang('admin.Mobile'): {{ $item->mobile }}</p>
                            <p>@lang('admin.ApartmentAddress'): {{ $item->address }}</p>
                        </div>
                        <div class="col-lg-3 pr-0">
                            <p class="mt-5 mb-2 text-right"><b>@lang('admin.RatesNo')</b></p>

                            <p class="text-right">{{ $item->request_no }}<br> {!! $item->status_span !!}</p>
                            <p class="mb-0 mt-1">@lang('admin.CreationDate') :
                                {{ \App\Helpers\ArabicDate::format($item->created_at, 'd M Y') }}</p>
                            <p>@lang('admin.LastUpdate') :
                                {{ \App\Helpers\ArabicDate::format($item->updated_at, 'd M Y') }}</p>
                        </div>
                    </div>

                    <div class="container-fluid mt-5 d-flex justify-content-center w-100">
                        <div class="table-responsive w-100">
                            <table class="table"  id="example">
                                <thead>
                                    <tr class="bg-dark text-white">

                                        <th>@lang('admin.Title')</th>
                                        <th class="text-right">@lang('admin.Description')</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-dark text-left ">@lang('admin.ApartmentGoal')</td>
                                        <td class="text-left">{{ $item->goal ? $item->goal->title : '' }} </td>
                                    </tr>
                                    <tr>
                                        <td class="text-dark text-left ">@lang('admin.ApartmentType')</td>
                                        <td class="text-left">{{ $item->type ? $item->type->title : '' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-dark text-left ">@lang('admin.ApartmentEntity')
                                        </td>
                                        <td class="text-left">{{ $item->entity ? $item->entity->title : '' }} </td>
                                    </tr>
                                    <tr>
                                        <td class="text-dark text-left ">@lang('admin.ApartmentAge')
                                        </td>
                                        <td class="text-left">{!! $item->real_estate_age !!} </td>
                                    <tr>
                                        <td class="text-dark text-left ">@lang('admin.ApartmentArea')
                                        </td>
                                        <td class="text-left"> {!! $item->real_estate_area !!} </td>
                                    <tr>
                                        <td class="text-dark text-left ">@lang('admin.ApartmentUsed')
                                        </td>
                                        <td class="text-left"> {{ $item->usage ? $item->usage->title : '' }}</td>
                                    </tr>

                                    <tr>
                                        <td class="text-dark text-left ">@lang('admin.ApartmentNotes')
                                        </td>
                                        <td class="text-left"> {!! $item->real_estate_details !!} </td>
                                    </tr>

                                    <tr>
                                        <td class="text-dark text-left ">@lang('admin.Notes')
                                        </td>
                                        <td class="text-left"> {!! $item->notes !!} </td>
                                    </tr>

                                    <tr>
                                        <td class="text-dark text-left ">@lang('admin.instrument_image')
                                        </td>
                                        <td class="text-left">
                                            @if (!empty($item->instrument_images))
                                                @foreach ($item->instrument_images as $file)
                                                        <a href="{!! $file !!}" download>
                                                        <img class="img-lg rounded" src="{!! $file !!}" />
                                                    </a>
                                                @endforeach
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-dark text-left ">@lang('admin.construction_license')
                                        </td>
                                        <td class="text-left">
                                            @if (!empty($item->construction_images))
                                                @foreach ($item->construction_images as $file)
                                                        <a href="{!! $file !!}" download>
                                                        <img class="img-lg rounded" src="{!! $file !!}" />
                                                    </a>
                                                @endforeach
                                            @endif

                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-dark text-left ">@lang('admin.other_contracts')
                                        </td>
                                        <td class="text-left">
                                            @if (!empty($item->other_images))
                                                @foreach ($item->other_images as $file)
                                                     <a href="{!! $file !!}" download>
                                                        <img class="img-lg rounded" src="{!! $file !!}" />
                                                    </a>
                                                @endforeach
                                            @endif
                                        </td>
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
