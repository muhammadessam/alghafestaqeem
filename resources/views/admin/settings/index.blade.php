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
                <h4 class="card-title">@lang('admin.EditAppSetting')
                </h4>
                <hr>
                <form class="needs-validation" action="{{ route('admin.settings.update', $setting->id) }}" method="POST" enctype='multipart/form-data' novalidate>
                    <input type="hidden" name="_method" value="PUT">

                    @csrf
                    <div class="row">
                        <div class="col-3">
                            <ul class="nav nav-tabs nav-tabs-vertical" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab-vertical" data-bs-toggle="tab" href="#home-2" role="tab" aria-controls="home-2" aria-selected="true">
                                        @lang('admin.About')
                                        <i class="ti-home text-primary ms-2 pull-left " style="margin-right: 0.5rem !important;margin-top: 4.5px;"></i>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="info-tab-vertical" data-bs-toggle="tab" href="#info-2" role="tab" aria-controls="info-2" aria-selected="true">
                                        @lang('admin.Address')
                                        <i class="ti-agenda text-info ms-2 pull-left " style="margin-right: 0.5rem !important;margin-top: 4.5px;"></i>
                                    </a>
                                </li>


                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab-vertical" data-bs-toggle="tab" href="#profile-2" role="tab" aria-controls="profile-2" aria-selected="false">
                                        @lang('admin.SocialLinks')
                                        <i class="ti-share-alt text-danger ms-2 pull-left " style="margin-right: 0.5rem !important;margin-top: 4.5px;"></i>
                                    </a>
                                </li>


                                <li class="nav-item">
                                    <a class="nav-link" id="contact-tab-vertical" data-bs-toggle="tab" href="#contact-2" role="tab" aria-controls="contact-2" aria-selected="false">
                                        @lang('admin.Titles')
                                        <i class="ti-info-alt text-success ms-2 pull-left " style="margin-right: 0.5rem !important;margin-top: 4.5px;"></i>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="upload-tab-vertical" data-bs-toggle="tab" href="#upload-2" role="tab" aria-controls="upload-2" aria-selected="false">
                                        @lang('admin.Uploads')
                                        <i class="ti-cloud-up text-info ms-2 pull-left " style="margin-right: 0.5rem !important;margin-top: 4.5px;"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-9">
                            <div class="tab-content tab-content-vertical">
                                <div class="tab-pane fade show active" id="home-2" role="tabpanel" aria-labelledby="home-tab-vertical">
                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="title-field">@lang('admin.Title')</label>
                                                <input id="title-field" type="text" required class="form-control @if ($errors->has('title')) is-invalid @endif" name="title" value="{{ old('title', $setting->title) }}" />
                                                @if ($errors->has('title'))
                                                <span class="invalid-feedback">{{ $errors->first('title') }}</span>
                                                @else
                                                <div class="invalid-feedback">Please enter valid title</div>
                                                @endif

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="email-field">@lang('admin.E-mail')</label>
                                                <input id="email-field" type="email" required class="form-control @if ($errors->has('email')) is-invalid @endif" name="email" value="{{ old('email', $setting->email) }}" />
                                                @if ($errors->has('email'))
                                                <span class="invalid-feedback">{{ $errors->first('email') }}</span>
                                                @else
                                                <div class="invalid-feedback">Please enter valid email</div>
                                                @endif

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="phone-field">@lang('admin.Phone')</label>

                                                <input id="phone-field" type="text" class="form-control @if ($errors->has('phone')) is-invalid @endif" name="phone" value="{{ old('phone', $setting->phone) }}" />
                                                @if ($errors->has('phone'))
                                                <span class="invalid-feedback">{{ $errors->first('phone') }}</span>
                                                @else
                                                <div class="invalid-feedback">Please enter valid pnone number
                                                </div>
                                                @endif
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="whats_app-field">@lang('admin.Whatsapp')</label>

                                                <input id="whats_app-field" type="text" class="form-control @if ($errors->has('whats_app')) is-invalid @endif" name="whats_app" value="{{ old('whats_app', $setting->whats_app) }}" />
                                                @if ($errors->has('whats_app'))
                                                <span class="invalid-feedback">{{ $errors->first('whats_app') }}</span>
                                                @else
                                                <div class="invalid-feedback">Please enter valid pnone number
                                                </div>
                                                @endif

                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="tab-pane fade" id="info-2" role="tabpanel" aria-labelledby="info-tab-vertical">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group ">
                                                <label for="address-field">
                                                    @lang('admin.Address')
                                                </label>
                                                <textarea id="address-field" rows="6" class="form-control @if ($errors->has('address')) is-invalid @endif" name='address'>{{ $setting->address ?? old('address') }}</textarea>
                                                @if ($errors->has('address'))
                                                <span class="invalid-feedback">{{ $errors->first('address') }}</span>
                                                @else
                                                <div class="invalid-feedback">please add

                                                    address </div>
                                                @endif
                                            </div>
                                        </div>


                                    </div>
                                </div>


                                <div class="tab-pane fade" id="profile-2" role="tabpanel" aria-labelledby="profile-tab-vertical">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="facebook-field">
                                                    @lang('admin.Facebook')
                                                </label>

                                                <input id="facebook-field" type="url" class="form-control @if ($errors->has('facebook')) is-invalid @endif" name="facebook" value="{{ old('facebook', $setting->facebook) }}" />
                                                @if ($errors->has('facebook'))
                                                <span class="invalid-feedback">{{ $errors->first('facebook') }}</span>
                                                @else
                                                <div class="invalid-feedback">Please enter valid facebook link
                                                </div>
                                                @endif

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="instagram-field">@lang('admin.Instagram')</label>

                                                <input id="instagram-field" type="url" class="form-control @if ($errors->has('instagram')) is-invalid @endif" name="instagram" value="{{ old('instagram', $setting->instagram) }}" />
                                                @if ($errors->has('instagram'))
                                                <span class="invalid-feedback">{{ $errors->first('instagram') }}</span>
                                                @else
                                                <div class="invalid-feedback">Please enter valid instagram link
                                                </div>
                                                @endif

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="twitter-field">@lang('admin.Twitter')
                                                </label>

                                                <input id="twitter-field" type="url" class="form-control @if ($errors->has('twitter')) is-invalid @endif" name="twitter" value="{{ old('twitter', $setting->twitter) }}" />
                                                @if ($errors->has('twitter'))
                                                <span class="invalid-feedback">{{ $errors->first('twitter') }}</span>
                                                @else
                                                <div class="invalid-feedback">Please enter valid twitter link
                                                </div>
                                                @endif

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="snapchat-field">@lang('admin.snapchat')
                                                </label>

                                                <input id="snapchat-field" type="url" class="form-control @if ($errors->has('snapchat')) is-invalid @endif" name="snapchat" value="{{ old('snapchat', $setting->snapchat) }}" />
                                                @if ($errors->has('snapchat'))
                                                <span class="invalid-feedback">{{ $errors->first('snapchat') }}</span>
                                                @else
                                                <div class="invalid-feedback">Please enter valid snapchat link
                                                </div>
                                                @endif

                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="linkedIn-field">@lang('admin.linkedIn')
                                                </label>

                                                <input id="linkedIn-field" type="url" class="form-control @if ($errors->has('linkedIn')) is-invalid @endif" name="linkedIn" value="{{ old('linkedIn', $setting->linkedIn) }}" />
                                                @if ($errors->has('linkedIn'))
                                                <span class="invalid-feedback">{{ $errors->first('linkedIn') }}</span>
                                                @else
                                                <div class="invalid-feedback">Please enter valid linkedIn link
                                                </div>
                                                @endif

                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="youTube-field">@lang('admin.Youtube')
                                                </label>

                                                <input id="youTube-field" type="url" class="form-control @if ($errors->has('youTube')) is-invalid @endif" name="youTube" value="{{ old('youTube', $setting->youTube) }}" />
                                                @if ($errors->has('youTube'))
                                                <span class="invalid-feedback">{{ $errors->first('youTube') }}</span>
                                                @else
                                                <div class="invalid-feedback">Please enter valid Youtube link
                                                </div>
                                                @endif
                                            </div>

                                        </div>


                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="telegram-field">@lang('admin.Telegram')
                                                </label>

                                                <input id="telegram-field" type="url" class="form-control @if ($errors->has('telegram')) is-invalid @endif" name="telegram" value="{{ old('telegram', $setting->telegram) }}" />
                                                @if ($errors->has('telegram'))
                                                <span class="invalid-feedback">{{ $errors->first('telegram') }}</span>
                                                @else
                                                <div class="invalid-feedback">Please enter valid telegram link
                                                </div>
                                                @endif
                                            </div>

                                        </div>


                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="appStore-field">@lang('admin.appStore')
                                                </label>

                                                <input id="appStore-field" type="url" class="form-control @if ($errors->has('appStore')) is-invalid @endif" name="appStore" value="{{ old('appStore', $setting->appStore) }}" />
                                                @if ($errors->has('appStore'))
                                                <span class="invalid-feedback">{{ $errors->first('appStore') }}</span>
                                                @else
                                                <div class="invalid-feedback">Please enter valid appStore link
                                                </div>
                                                @endif

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="googlePlay-field" class="col-sm-3 col-form-label">@lang('admin.googlePlay')
                                                </label>

                                                <input id="googlePlay-field" type="url" class="form-control @if ($errors->has('googlePlay')) is-invalid @endif" name="googlePlay" value="{{ old('googlePlay', $setting->googlePlay) }}" />
                                                @if ($errors->has('googlePlay'))
                                                <span class="invalid-feedback">{{ $errors->first('googlePlay') }}</span>
                                                @else
                                                <div class="invalid-feedback">Please enter valid googlePlay link
                                                </div>
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="contact-2" role="tabpanel" aria-labelledby="contact-tab-vertical">
                                    <div class=" row ">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="objective-field">@lang('admin.Objective')</label>
                                                <input id="objective-field" type="text" required class="form-control @if ($errors->has('objective')) is-invalid @endif" name="objective" value="{{ old('objective', $setting->objective) }}" />
                                                @if ($errors->has('objective'))
                                                <span class="invalid-feedback">{{ $errors->first('objective') }}</span>
                                                @else
                                                <div class="invalid-feedback">Please enter valid objective</div>
                                                @endif

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="service-field">@lang('admin.Service')</label>
                                                <input id="service-field" type="text" required class="form-control @if ($errors->has('service')) is-invalid @endif" name="service" value="{{ old('service', $setting->service) }}" />
                                                @if ($errors->has('service'))
                                                <span class="invalid-feedback">{{ $errors->first('service') }}</span>
                                                @else
                                                <div class="invalid-feedback">Please enter valid service</div>
                                                @endif

                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="slider-field">@lang('admin.Slider')</label>
                                                <input id="slider-field" type="text" required class="form-control @if ($errors->has('slider')) is-invalid @endif" name="slider" value="{{ old('slider', $setting->slider) }}" />
                                                @if ($errors->has('slider'))
                                                <span class="invalid-feedback">{{ $errors->first('slider') }}</span>
                                                @else
                                                <div class="invalid-feedback">Please enter valid slider</div>
                                                @endif

                                            </div>
                                        </div>

                                        <div class="col-md-12"></div>

                                        <div class="col-md-6">
                                            <div class="form-group ">
                                                <label for="about-field">
                                                    @lang('admin.About')
                                                </label>
                                                <textarea id="about-field" rows="6" class="tinyMceExample form-control @if ($errors->has('about')) is-invalid @endif" name='about'>{{ $setting->about ?? old('about') }}</textarea>
                                                @if ($errors->has('about'))
                                                <span class="invalid-feedback">{{ $errors->first('about') }}</span>
                                                @else
                                                <div class="invalid-feedback">please add about </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group ">
                                                <label for="footer-field">
                                                    @lang('admin.FooterAbout')
                                                </label>
                                                <textarea id="footer-field" rows="6" class="form-control @if ($errors->has('footer')) is-invalid @endif" name='footer'>{{ $setting->footer ?? old('footer') }}</textarea>
                                                @if ($errors->has('footer'))
                                                <span class="invalid-feedback">{{ $errors->first('footer') }}</span>
                                                @else
                                                <div class="invalid-feedback">please add
                                                    footer </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="upload-2" role="tabpanel" aria-labelledby="upload-tab-vertical">
                                    <div class="row">


                                        <div class="col-md-6">
                                            <div class="form-group row ">
                                                <label for="about_image-field" class="col-sm-3 col-form-label">
                                                    @lang('admin.About')</label>

                                                <div class="col-sm-9">
                                                    <div style="width: 100px;height: 100px;">
                                                        <img src="{{ old('about_image', $setting->imagePath('about_image')) }}" id="preview" width="100%">
                                                    </div>
                                                    <input type="file" name="about_image" class="custom-file-input" id="about_image-field">
                                                    @if ($errors->has('about_image'))
                                                    <span class="invalid-feedback">{{ $errors->first('about_image') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group row ">
                                                <label for="objective_image-field" class="col-sm-3 col-form-label">
                                                    @lang('admin.ObjectiveImage')</label>

                                                <div class="col-sm-9">
                                                    <div style="width: 100px;height: 100px;">
                                                        <img src="{{ old('objective_image', $setting->imagePath('objective_image')) }}" id="preview" width="100%">
                                                    </div>
                                                    <input type="file" name="objective_image" class="custom-file-input" id="objective_image-field">
                                                    @if ($errors->has('objective_image'))
                                                    <span class="invalid-feedback">{{ $errors->first('objective_image') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group row ">
                                                <label for="slider_image-field" class="col-sm-3 col-form-label">@lang('admin.SliderImage')
                                                </label>

                                                <div class="col-sm-9">
                                                    <div style="width: 100px;height: 100px;">
                                                        <img src="{{ old('slider_image', $setting->imagePath('slider_image')) }}" id="preview" width="100%">
                                                    </div>
                                                    <input type="file" name="slider_image" class="custom-file-input" id="slider_image-field">
                                                    @if ($errors->has('slider_image'))
                                                    <span class="invalid-feedback">{{ $errors->first('slider_image') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group row ">
                                                <label for="page_background-field" class="col-sm-3 col-form-label">
                                                    @lang('admin.PageHeader')</label>
                                                <div class="col-sm-9">
                                                    <div style="width: 100px;height: 100px;">
                                                        <img src="{{ old('page_background', $setting->imagePath('page_background')) }}" id="preview" width="100%">
                                                    </div>
                                                    <input type="file" name="page_background" class="custom-file-input" id="page_background-field">
                                                    @if ($errors->has('page_background'))
                                                    <span class="invalid-feedback">{{ $errors->first('page_background') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row ">
                                                <label for="logo-field" class="col-sm-3 col-form-label">@lang('admin.Logo')
                                                </label>

                                                <div class="col-sm-9">
                                                    <div style="width: 100px;height: 100px;">
                                                        <img src="{{ old('logo', $setting->imagePath('logo')) }}" id="preview" width="100%">
                                                    </div>
                                                    <input type="file" name="logo" class="custom-file-input" id="logo-field">
                                                    @if ($errors->has('logo'))
                                                    <span class="invalid-feedback">{{ $errors->first('logo') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group row ">
                                                <label for="logo_white-field" class="col-sm-3 col-form-label">@lang('admin.LogoWhite')
                                                </label>

                                                <div class="col-sm-9">
                                                    <div style="width: 100px;height: 100px;">
                                                        <img src="{{ old('logo_white', $setting->imagePath('logo_white')) }}" id="preview" width="100%">
                                                    </div>
                                                    <input type="file" name="logo_white" class="custom-file-input" id="logo_white-field">
                                                    @if ($errors->has('logo_white'))
                                                    <span class="invalid-feedback">{{ $errors->first('logo_white') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>



                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <hr>
                        <button type="submit" name="action" value="save" class="btn text-white btn-primary">@lang('admin.Save')</button>

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
<script src="https://cdn.tiny.cloud/1/z4r871g6sjhoi8cm8vidvde8cedb47jwuhfdwxfdw1av9wpi/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>


<script src="/assets/js/upload.js"></script>
<script src="/assets/js/validate.js"></script>
<script>
    tinymce.init({
        selector: '.tinyMceExample'
        , plugins: 'lists'
        , toolbar: ' bold italic numlist bullist'
    });

</script>
@endsection
