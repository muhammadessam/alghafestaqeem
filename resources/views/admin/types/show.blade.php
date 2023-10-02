@extends('admin.layouts.app')
@section('tab_name', __('admin.types'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card ">
                <div class="card-body">
                    <h4>
                        @lang('admin.types') #{{ $item->id }} {!! $item->active_span !!}
                    </h4>
                    <hr>
                    <table class="table">
                        <tbody>
                            <tr>
                                <th width="25%"> <i class="mdi mdi-minus-box"></i>@lang('admin.image') </th>
                                <td> <i class="mdi mdi-pin"></i>
                                    <img src="{{ $item->image ?? '' }}">
                                </td>
                            </tr>
                            <tr>
                                <th width="25%"> <i class="icon-minus-box"></i> @lang('admin.Title') En </th>
                                <td> <i class="icon-pin"></i>
                                    {{ $item->translate('ar')->name ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <th width="25%"> <i class="icon-minus-box"></i>@lang('admin.Title') Ar </th>
                                <td> <i class="icon-pin"></i>
                                    {{ $item->translate('en')->name ?? '' }}
                                </td>
                            </tr>

                            <tr>
                                <th width="25%"> <i class="icon-minus-box"></i>@lang('admin.SubTitle') En </th>
                                <td> <i class="icon-pin"></i>
                                    {{ $item->translate('ar')->sub_title ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <th width="25%"> <i class="icon-minus-box"></i>@lang('admin.SubTitle') Ar </th>
                                <td> <i class="icon-pin"></i>
                                    {{ $item->translate('en')->sub_title ?? '' }}
                                </td>
                            </tr>

                            <tr>
                                <th width="25%"> <i class="icon-minus-box"></i>@lang('admin.Position')</th>
                                <td> <i class="icon-pin"></i>
                                    {{ $item->position }}
                                </td>
                            </tr>
                            <tr>
                                <th width="25%"> <i class="icon-minus-box"></i>@lang('admin.CreationDate') </th>
                                <td> <i class="icon-pin"></i>
                                    {{ $item->created_at }}
                                </td>
                            </tr>
                            <tr>
                                <th width="25%"> <i class="icon-minus-box"></i>@lang('admin.LastUpdate')</th>
                                <td> <i class="icon-pin"></i>
                                    {{ $item->updated_at }}
                                </td>
                            </tr>

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection
