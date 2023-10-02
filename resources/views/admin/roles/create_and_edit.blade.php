@extends('admin.layouts.app')
@section('tab_name', __('admin.Roles'))
@section('css')
    <link rel="stylesheet" href="{{ asset('/panel/vendors/dropify/dropify.min.css') }}">
    <style>
        .tab-content {
            border: 0px solid #ced4da;

            padding: 2rem 1rem;
            text-align: justify;
        }

    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-name">@lang('admin.Roles') /
                        @if ($item->id)
                            @lang('admin.Edit') #{{ $item->id }}
                        @else
                            @lang('admin.Add')
                        @endif
                    </h4>
                    <hr>
                    @if ($item->id)
                        <form class="needs-validation" action="{{ route('admin.roles.update', $item->id) }}" method="POST"
                            enctype='multipart/form-data' novalidate>
                            <input type="hidden" name="_method" value="PUT">
                        @else
                            <form class="needs-validation" action="{{ route('admin.roles.store') }}" method="POST"
                                enctype='multipart/form-data' novalidate>

                    @endif
                    @csrf

                    <div class="row">
                        <div class="col-md-6">

                            <div class="col-md-12">
                                <div class="form-group ">
                                    <label for="title-field"> @lang('admin.Title')</label>
                                    <input required id="title-field" type="text" class="form-control @if ($errors->has('title')) is-invalid @endif"
                                    name='title'
                                    value="{{ $item->title ?? old('title') }}" />
                                    @if ($errors->has('title'))
                                        <span class="invalid-feedback">{{ $errors->first('title') }}</span>
                                    @else
                                        <div class="invalid-feedback">please add title
                                        </div>
                                    @endif
                                </div>
                            </div>




                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group ">
                                        <label for="name-field"> @lang('admin.role_name')</label>
                                        <input required id="name-field" type="text" class="form-control @if ($errors->has('name')) is-invalid @endif"
                                        name='name' {{ $item->name == 'super-admin' ? 'disabled readonly' : '' }}
                                        value="{{ $item->name ?? old('name') }}" />
                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback">{{ $errors->first('name') }}</span>
                                        @else
                                            <div class="invalid-feedback">please add name
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            @include('admin.roles.permission')
                        </div>
                        <div class="col-md-12">
                            <hr>
                            <button type="submit" name="action" value="save"
                                class="btn btn-primary">@lang('admin.Save')</button>

                            <a class="btn btn-danger pull-right text-white"
                                href="{{ route('admin.roles.index') }}">@lang('admin.Cancel') <i
                                    class="icon-arrow-left-bold"></i></a>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script src="{{ asset('/panel/js/validate.js') }}"></script>
    <script src="{{ asset('/panel/vendors/dropify/dropify.min.js') }}"></script>
    <script src="{{ asset('/panel/js/dropify.js') }}"></script>
@endsection
