<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
        <a class="navbar-brand brand-logo me-5" href="{{ route('admin.home') }}"><img
                src="{{ $setting->imagePath('logo') ?? asset('/images/logo.png') }}" class="me-2" alt="logo" /></a>
        <a class="navbar-brand brand-logo-mini" href="{{ route('admin.home') }}"><img
                src="{{ $setting->imagePath('logo') ?? asset('/images/logo.png') }}" alt="logo" /></a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="icon-menu"></span>
        </button>
        <ul class="navbar-nav mr-lg-2">
            <li class="nav-item nav-search d-none d-lg-block">
                <div class="input-group">

                </div>
            </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
              <!-- Notifications: style can be found in dropdown.less -->
             <li  class="nav-item nav-profile dropdown notifications-menu"  id="Read">
                  <a href="#" class="dropdown-toggle " data-bs-toggle="dropdown" id="markAsread">
                      <i class="fa fa-bell  Read"></i>
                  <span class="label label-warning">{{count(auth()->user()->unreadNotifications)}}</span>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="markAsread">

                  <ul class="dropdown-item " >
                   
                      <!-- inner menu: contains the actual data -->
                        
                        @foreach (auth()->user()->unreadNotifications as $notification) 
                        @if($notification->read_at ==null)
                        <li style="display: block !important;padding: 10px 7px;text-align: right !important; border-bottom: 1px solid #f3f3f3;" class=" dropdown-item">
                        @if($notification->type=='App\Notifications\Transaction')
                        <a style="color: #000;font-size: 14px;font-weight: bold;text-decoration: inherit; padding: 12px 0px;" href="{{ route('admin.evaluation-transactions.show', $notification->data['Transaction']['id']) }}">
                       
                                  {{$notification->data['type']}} بواسطة  {{$notification->data['user']['name']}} بتاريخ  {{$notification->created_at}}
                        </a>
                        @endif
                        <!--  -->
                       
                        </li>
                        @endif
                          
                        @endforeach
                       <li style="display: block !important;padding: 10px 7px;text-align: right !important; border-bottom: 1px solid #f3f3f3;" class=" dropdown-item">
                        <a style="color: #000;font-size: 14px;font-weight: bold;text-decoration: inherit; padding: 12px 0px;" href="{{ url('admin/notifucation') }}">
                            إظهار المزيد
                        </a>
                      </li>



                      
                        

                  </ul>
                  </div>
             </li>

            <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
                    <img src="{{ asset('/images/user.png') }}" alt="profile" />
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                    <a href="{{ route('admin.profile') }}" class="dropdown-item">
                        <i class="ti-profile text-primary"></i>
                        @lang('admin.Profile')
                    </a>
                    <a href="{!! route('admin.logout') !!}" class="dropdown-item"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="ti-power-off text-primary"></i> @lang('admin.Logout')
                    </a>
                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>

                </div>
            </li>

        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
            data-toggle="offcanvas">
            {{-- <span class="icon-menu"></span> --}}
        </button>
    </div>
</nav>
