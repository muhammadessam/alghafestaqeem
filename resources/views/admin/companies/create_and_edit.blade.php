@extends('admin.layouts.app')
@section('tab_name', __('admin.Companies'))
@section('css')
<link rel="stylesheet" href="/panel/vendors/dropify/dropify.min.css">
<link rel="stylesheet" href="/panel/vendors/select2/select2.min.css">
<style>
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background: #ecc5cc !important;
        font-size: 15px;
        padding: 5px;
    }

    .select2-container .select2-selection--single {
        box-sizing: border-box;
        cursor: pointer;
        display: block;
        height: 58px;
        user-select: none;
        -webkit-user-select: none;
    }

</style>

@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-name">@lang('admin.Companies') /
                    @if ($item->id)
                    @lang('admin.Edit') #{{ $item->id }}
                    @else
                    @lang('admin.Add')
                    @endif
                </h4>
                <hr>
                @if ($item->id)
                <form class="needs-validation" action="{{ route('admin.companies.update', $item->id) }}" method="POST" enctype='multipart/form-data' novalidate>
                    <input type="hidden" name="_method" value="PUT">
                    @else
                    <form class="needs-validation" action="{{ route('admin.companies.store') }}" method="POST" enctype='multipart/form-data' novalidate>
                        <input type="hidden" value="" name="service_id" />
                        @endif
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="form-group ">
                                            <label for="title-field"> @lang('admin.Title')</label>
                                            <input required id="title-field" type="text" class="form-control @if ($errors->has('title')) is-invalid @endif" name='title' value="{{ $item->title ?? old('title') }}" />
                                            @if ($errors->has('title'))
                                            <span class="invalid-feedback">{{ $errors->first('title') }}</span>
                                            @else
                                            <div class="invalid-feedback">please add title
                                            </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <label for="email-field"> @lang('admin.E-mail')</label>
                                            <input required id="email-field" type="text" class="form-control @if ($errors->has('email')) is-invalid @endif" name='email' value="{{ $item->email ?? old('email') }}" />
                                            @if ($errors->has('email'))
                                            <span class="invalid-feedback">{{ $errors->first('email') }}</span>
                                            @else
                                            <div class="invalid-feedback">please add email
                                            </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <label for="link-field"> @lang('admin.Link')</label>
                                            <input required id="link-field" type="text" class="form-control @if ($errors->has('link')) is-invalid @endif" name='link' value="{{ $item->link ?? old('link') }}" />
                                            @if ($errors->has('link'))
                                            <span class="invalid-feedback">{{ $errors->first('link') }}</span>
                                            @else
                                            <div class="invalid-feedback">please add link
                                            </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="service_id-field">@lang('admin.CompanyServices')</label>
                                            <select id="service_id-field" class="form-control js-example-basic-multiple" multiple name="service_id[]">

                                                @if (!empty($result['services']))
                                                @foreach ($result['services'] as $service)
                                                <option {{ in_array($service->id, old('service_id', $item->service_ids ?? [])) ? 'selected' : '' }} value="{{ $service->id }}">
                                                    {{ $service->title }}
                                                </option>
                                                @endforeach
                                                @endif

                                            </select>
                                            @if ($errors->has('service_id'))
                                            <span class="invalid-feedback">{{ $errors->first('service_id') }}</span>
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
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="active-field">@lang('admin.Publish')</label>
                                            <select class="form-control" name="active">
                                                <option {{ old('active', $item->active) == '1' ? 'selected' : '' }} value="1">
                                                    @lang('admin.Yes')</option>
                                                <option {{ old('active', $item->active) == '0' ? 'selected' : '' }} value="0">
                                                    @lang('admin.No')</option>
                                            </select>
                                            @if ($errors->has('active'))
                                            <span class="invalid-feedback">{{ $errors->first('active') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="position-field">@lang('admin.Position')</label>
                                            <input type="number" min="0" step="1" required class="form-control @if ($errors->has('position')) is-invalid @endif" name="position" value="{{ old('position', $item->position) ?? '0' }}" />
                                            @if ($errors->has('position'))
                                            <span class="invalid-feedback">{{ $errors->first('position') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <label for="mobile-field"> @lang('admin.Mobile')</label>
                                            <input required id="mobile-field" type="text" class="form-control @if ($errors->has('mobile')) is-invalid @endif" name='mobile' value="{{ $item->mobile ?? old('mobile') }}" />
                                            @if ($errors->has('mobile'))
                                            <span class="invalid-feedback">{{ $errors->first('mobile') }}</span>
                                            @else
                                            <div class="invalid-feedback">please add mobile
                                            </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <label for="whats_app-field"> @lang('admin.Whatsapp')</label>
                                            <input required id="whats_app-field" type="text" class="form-control @if ($errors->has('whats_app')) is-invalid @endif" name='whats_app' value="{{ $item->whats_app ?? old('whats_app') }}" />
                                            @if ($errors->has('whats_app'))
                                            <span class="invalid-feedback">{{ $errors->first('whats_app') }}</span>
                                            @else
                                            <div class="invalid-feedback">please add whatsapp
                                            </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group ">
                                            <label for="description-field"> @lang('admin.Description')
                                            </label>
                                            <textarea id="description-field" rows="15" class="form-control @if ($errors->has('description')) is-invalid @endif" name='description'>{{ $item->description ?? old('description') }}</textarea>
                                            @if ($errors->has('description'))
                                            <span class="invalid-feedback">{{ $errors->first('description') }}</span>
                                            @else
                                            <div class="invalid-feedback">please add description </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <hr>
                                <button type="submit" name="action" value="save" class="btn btn-primary">@lang('admin.Save')</button>

                                <a class="btn btn-danger pull-right text-white" href="{{ route('admin.companies.index') }}">@lang('admin.Cancel') <i class="icon-arrow-left-bold"></i></a>
                            </div>
                        </div>
                    </form>
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
<script src="/panel/vendors/select2/select2.min.js"></script>
<script src="/panel/js/select2.js"></script>
<script src="/panel/js/validate.js"></script>
<script src="/panel/vendors/dropify/dropify.min.js"></script>
<script src="/panel/js/dropify.js"></script>
@endsection
