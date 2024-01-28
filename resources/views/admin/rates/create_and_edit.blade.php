@extends('admin.layouts.app')
@section('tab_name', __('admin.Rates'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">@lang('admin.Rates') /
                    @if ($item->id)
                    @lang('admin.Edit') #{{ $item->id }}
                    @else
                    Add
                    @endif
                </h4>
                <hr>
                @if ($item->id)
                <form class="needs-validation" action="{{ route('admin.rates.update', $item->id) }}" method="POST" enctype='multipart/form-data' novalidate>
                    <input type="hidden" name="_method" value="PUT">
                    @else
                    <form class="needs-validation" action="{{ route('admin.rates.store') }}" method="POST" enctype='multipart/form-data' novalidate>
                        @endif
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row ">
                                    <label for="name-field" class="col-sm-3 col-form-label"> @lang('admin.UserName')
                                    </label>
                                    <div class="col-sm-9 ">
                                        <input disabled required id="name-field" type="text" class="form-control @if ($errors->has('name')) is-invalid @endif" name="name" value="{{ $item->name ?? old('name') }}" />
                                        @if ($errors->has('name'))
                                        <span class="invalid-feedback">{{ $errors->first('name') }}</span>
                                        @else
                                        <div class="invalid-feedback">please add user Name </div>
                                        @endif

                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group row ">
                                    <label for="email-field" class="col-sm-3 col-form-label"> @lang('admin.E-mail') </label>
                                    <div class="col-sm-9 ">
                                        <input disabled required id="email-field" type="text" class="form-control @if ($errors->has('email')) is-invalid @endif" name="email" value="{{ $item->email ?? old('email') }}" />
                                        @if ($errors->has('email'))
                                        <span class="invalid-feedback">{{ $errors->first('email') }}</span>
                                        @else
                                        <div class="invalid-feedback">please add E-mail </div>
                                        @endif

                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group row ">
                                    <label for="mobile-field" class="col-sm-3 col-form-label"> @lang('admin.Phone') </label>
                                    <div class="col-sm-9 ">
                                        <input disabled required id="mobile-field" type="text" class="form-control @if ($errors->has('mobile')) is-invalid @endif" name="mobile" value="{{ $item->mobile ?? old('mobile') }}" />
                                        @if ($errors->has('mobile'))
                                        <span class="invalid-feedback">{{ $errors->first('mobile') }}</span>
                                        @else
                                        <div class="invalid-feedback">please add mobile </div>
                                        @endif

                                    </div>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group row ">
                                    <label for="status-field" class="col-sm-3 col-form-label"> @lang('admin.Status')</label>
                                    <div class="col-sm-9 @if ($errors->has('status')) is-invalid @endif">
                                        <select class="form-control" name="status">
                                            @foreach ($statuses as $status)
                                            <option {{ old('status', $item->status) == $status['id'] ? 'selected' : '' }} value="{{ $status['id'] }}">
                                                {{ __('admin.' . $status['title']) }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('status'))
                                        <span class="invalid-feedback">{{ $errors->first('status') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>



                            <div class="col-md-12"></div>

                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label" for="notes-field">@lang('admin.Notes')</label>
                                    <div class="col-sm-9 @if ($errors->has('notes')) is-invalid @endif">

                                        <textarea class="form-control @if ($errors->has('notes')) is-invalid @endif" name="notes" rows="10">{{ old('notes', $item->notes) ?? '' }}</textarea>
                                        @if ($errors->has('notes'))
                                        <span class="invalid-feedback">{{ $errors->first('notes') }}</span>
                                        @endif
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-12">
                                <hr>
                                <button type="submit" name="action" value="save" class="btn btn-primary">@lang('admin.Save')</button>

                                <a class="btn btn-danger pull-right text-white" href="{{ route('admin.rates.index') }}">
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
<script src="/panel/js/upload.js"></script>
<script src="/panel/js/validate.js"></script>
@endsection
