@extends('admin.layouts.app')
@section('tab_name', __('admin.Profile'))
@section('css')
<link rel="stylesheet" href="/panel/vendors/dropify/dropify.min.css">
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-name"> @lang('admin.Profile')
                </h4>
                <hr>
                <form class="needs-validation" action="{{ route('admin.profile.update') }}" method="POST" enctype='multipart/form-data' novalidate>
                    <input type="hidden" name="_method" value="PUT">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name-field">@lang('admin.Name')</label>
                                        <input type="name" required class="form-control @if ($errors->has('name')) is-invalid @endif" name="name" value="{{ old('name', $item->name) ?? '' }}" />
                                        @if ($errors->has('name'))
                                        <span class="invalid-feedback">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="email-field">@lang('admin.E-mail')</label>
                                        <input type="email" required class="form-control @if ($errors->has('email')) is-invalid @endif" name="email" value="{{ old('email', $item->email) ?? '' }}" />
                                        @if ($errors->has('email'))
                                        <span class="invalid-feedback">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="mobile-field">@lang('admin.Mobile')</label>
                                        <input type="tel" min="10" required class="form-control @if ($errors->has('mobile')) is-invalid @endif" name="mobile" value="{{ old('mobile', $item->mobile) ?? '' }}" />
                                        @if ($errors->has('mobile'))
                                        <span class="invalid-feedback">{{ $errors->first('mobile') }}</span>
                                        @endif
                                    </div>
                                </div>


                            </div>
                        </div>
                        <div class="col-md-6">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password-field">@lang('admin.Password')</label>
                                        <input type="password" class="form-control @if ($errors->has('password')) is-invalid @endif" name="password" value="" />
                                        @if ($errors->has('password'))
                                        <span class="invalid-feedback">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password_confirmation-field">@lang('admin.PasswordConfirmation')</label>
                                        <input type="password" class="form-control @if ($errors->has('password_confirmation')) is-invalid @endif" name="password_confirmation" value="{{ old('password_confirmation', $item->password_confirmation) ?? '' }}" />
                                        @if ($errors->has('password_confirmation'))
                                        <span class="invalid-feedback">{{ $errors->first('password_confirmation') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group ">
                                        <label for="image-field">@lang('admin.UploadImage')</label>
                                        <input type="file" name="image" accept="image/png, image/jpeg, image/jpg" data-default-file="{{ old('image', $item->image) }}" class="dropify" id="image-field">
                                        @if ($errors->has('image'))
                                        <span class="invalid-feedback">{{ $errors->first('image') }}</span>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <hr>
                            <button type="submit" name="action" value="save" class="btn btn-primary">@lang('admin.Save')</button>

                            <a class="btn btn-danger pull-right text-white" href="{{ route('admin.home') }}">@lang('admin.Cancel') <i class="icon-arrow-left-bold"></i></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
<script src="/panel/js/validate.js"></script>
<script src="/panel/vendors/dropify/dropify.min.js"></script>
<script src="/panel/js/dropify.js"></script>
@endsection
