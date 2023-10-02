@extends('admin.layouts.app')
@section('tab_name', __('admin.AppSetting'))
@section('title')
    @lang('admin.AppSetting')
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">@lang('admin.privacy')
                    </h4>
                    <hr>
                    <form class="needs-validation" action="{{ route('admin.privacy.update', $Privacy->id) }}"
                        method="POST" enctype='multipart/form-data' novalidate>
                        <input type="hidden" name="_method" value="PUT">

                        @csrf
                        <div class="row">
                            <div class="col-3">
                       
                            </div>
                            <div class="col-9">
                                <div class="tab-content tab-content-vertical">
                                  
                                    <div class=" " id="info-2" role="tabpanel"
                                        aria-labelledby="info-tab-vertical">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group ">
                                                    <label for="Privacy-field">
                                                        @lang('admin.privacy_en')
                                                    </label>
                                                    <textarea id="address-field" rows="6" class="tinyMceExample form-control @if ($errors->has('address')) is-invalid @endif"
                                                                             name='privacy_en'>{{ $Privacy->privacy_en ?? old('privacy_en') }}</textarea>
                                                    @if ($errors->has('privacy_en'))
                                                        <span
                                                            class="invalid-feedback">{{ $errors->first('privacy_en') }}</span>
                                                    @else
                                                        <div class="invalid-feedback">please add

                                                        privacy_en </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group ">
                                                    <label for="Privacy-field">
                                                        @lang('admin.privacy_ar')
                                                    </label>
                                                    <textarea id="address-field" rows="6" class="tinyMceExample form-control @if ($errors->has('address')) is-invalid @endif"
                                                                             name='privacy_ar'>{{ $Privacy->privacy_ar ?? old('privacy_ar') }}</textarea>
                                                    @if ($errors->has('privacy_ar'))
                                                        <span
                                                            class="invalid-feedback">{{ $errors->first('privacy_ar') }}</span>
                                                    @else
                                                        <div class="invalid-feedback">please add

                                                        privacy_en </div>
                                                    @endif
                                                </div>
                                            </div>


                                        </div>
                                    </div>


                                   
                                    </div>
                                   
                            </div>
                        </div>
                        <div class="col-md-12">
                            <hr>
                            <button type="submit" name="action" value="save"
                                class="btn text-white btn-primary">@lang('admin.Save')</button>

                            <a class="btn text-white btn-danger pull-right" href="{{ route('admin.settings.index') }}">
                                @lang('admin.Cancel')<i class="icon-arrow-right-bold"></i></a>
                        </div>
                </div>
            </div>
            </form>
        </div>
    </div>
    </div>
    </div>

@endsection
@section('scripts')
    <script src="https://cdn.tiny.cloud/1/z4r871g6sjhoi8cm8vidvde8cedb47jwuhfdwxfdw1av9wpi/tinymce/5/tinymce.min.js"
        referrerpolicy="origin"></script>


    <script src="{{ asset('/assets/js/upload.js') }}"></script>
    <script src="{{ asset('/assets/js/validate.js') }}"></script>
    <script>
        tinymce.init({
            selector: '.tinyMceExample',
            plugins: 'lists',
            toolbar: ' bold italic numlist bullist'
        });

    </script>
@endsection
