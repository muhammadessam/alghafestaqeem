<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        @if (can('dashboard.index'))
        <li class="nav-item {{ Request::routeIs('admin.home') ? 'active' : '' }} ">
            <a class="nav-link" href="{{ route('admin.home') }}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">@lang('admin.dashboard')</span>
            </a>
        </li>
        @endif
        <li class="nav-item {{ Request::routeIs('admin.statistics.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.statistics.index') }}">
                <i class="icon-stack-2 menu-icon"></i>
                <span class="menu-title">@lang('admin.statistics') </span>
            </a>
        </li>
        @if (can('rates.index'))
        <li class="nav-item {{ Request::routeIs('admin.rates.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.rates.index') }}">
                <i class="icon-list menu-icon"></i>
                <span class="menu-title">@lang('admin.Rates') </span>
            </a>
        </li>
        @endif
        <li class="nav-item {{ Request::routeIs('admin.pdf.form') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.pdf.form') }}">
                <i class="icon-list menu-icon"></i>
                <span class="menu-title">@lang('admin.price_offer') </span>
            </a>
        </li>
        @if (can('contracts.index'))
        <li class="nav-item {{ Request::routeIs('admin.contracts.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.contracts.index') }}">
                <i class="icon-docs menu-icon"></i>
                <span class="menu-title">@lang('admin.contracts') </span>
            </a>
        </li>
        @endif
        @if (can('evaluation-transactions.index') || can('evaluation-companies.index') ||
        can('evaluation-employees.index'))
        <li
            class="nav-item {{ Request::routeIs('admin.evaluation-transactions.*')  || Request::routeIs('admin.cities.*') || Request::routeIs('admin.evaluation-companies.*') || Request::routeIs('admin.evaluation-employees.*') ? 'active' : '' }}">
            <a class="nav-link" data-bs-toggle="collapse" href="#evaluation-elements" aria-expanded="false"
                aria-controls="evaluation-elements">
                <i class="icon-wallet menu-icon"></i>
                <span class="menu-title">@lang('admin.EvaluationTransaction')</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{ Request::routeIs('admin.evaluation-transactions.*') || Request::routeIs('admin.cities.*') || Request::routeIs('admin.evaluation-companies.*') || Request::routeIs('admin.evaluation-employees.*') ? 'show' : '' }}"
                id="evaluation-elements">
                <ul class="nav flex-column sub-menu">
                    @if (can('evaluation-transactions.index'))
                    <li class="nav-item {{ Request::routeIs('admin.evaluation-transactions.*') ? 'activeItem' : '' }}">
                        <a class="nav-link" href="{{ route('admin.evaluation-transactions.index') }}">
                            @lang('admin.EvaluationTransactions')
                        </a>
                    </li>
                    @endif
                    <!-- sh -->
                    @if (can('evaluation-transactions.index'))
                    <li class="nav-item {{ Request::routeIs('admin.evaluation-transactions.*') ? 'activeItem' : '' }}">
                        <a class="nav-link" href="{{ url('admin/daily-transactions') }}">
                            @lang('admin.dailyTransactions')
                        </a>
                    </li>
                    @endif

                    @if (can('evaluation-transactions.index'))
                    <li class="nav-item {{ Request::routeIs('admin.evaluation-transactions.*') ? 'activeItem' : '' }}">
                        <a class="nav-link" href="{{ url('admin/Company-All-Transactions') }}">
                            @lang('admin.TransactionsAllCompany')
                        </a>
                    </li>
                    @endif
                    @if (can('evaluation-transactions.index'))
                    <li class="nav-item {{ Request::routeIs('admin.evaluation-transactions.*') ? 'activeItem' : '' }}">
                        <a class="nav-link" href="{{ url('admin/Review-transactions') }}">
                            @lang('admin.reviewTransactions')
                        </a>
                    </li>
                    @endif
                    @if (can('evaluation-transactions.index'))
                    <li class="nav-item {{ Request::routeIs('admin.evaluation-transactions.*') ? 'activeItem' : '' }}">
                        <a class="nav-link" href="{{ url('admin/company_transactions') }}">
                            @lang('admin.company_transactions')
                        </a>
                    </li>
                    @endif
                    @if (can('evaluation-transactions.index'))
                    <li class="nav-item {{ Request::routeIs('admin.evaluation-transactions.*') ? 'activeItem' : '' }}">
                        <a class="nav-link" href="{{ url('admin/user_transactions') }}">
                            @lang('admin.user_transactions')
                        </a>
                    </li>
                    @endif
                    <!---->
                    @if (can('evaluation-companies.index'))
                    <li class="nav-item {{ Request::routeIs('admin.evaluation-companies.*') ? 'activeItem' : '' }}">
                        <a class="nav-link" href="{{ route('admin.evaluation-companies.index') }}">
                            @lang('admin.EvaluationCompanies')
                        </a>
                    </li>
                    @endif
                    @if (can('evaluation-employees.index'))

                    <li class="nav-item {{ Request::routeIs('admin.evaluation-employees.*') ? 'activeItem' : '' }}">
                        <a class="nav-link" href="{{ route('admin.evaluation-employees.index') }}">
                            @lang('admin.EvaluationEmployees')
                        </a>
                    </li>
                    @endif

                    @if (can('cities.index'))

                    <li class="nav-item {{ Request::routeIs('admin.cities.*') ? 'activeItem' : '' }}">
                        <a class="nav-link" href="{{ route('admin.cities.index') }}">
                            @lang('admin.cities')
                        </a>
                    </li>
                    @endif


                </ul>
            </div>
        </li>
        @endif
        @if (can('admins.index') || can('roles.index'))
        <li
            class="nav-item {{ Request::routeIs('admin.admins.*') || Request::routeIs('admin.roles.*') ? 'active' : '' }}">
            <a class="nav-link" data-bs-toggle="collapse" href="#admins-elements" aria-expanded="false"
                aria-controls="admins-elements">
                <i class="icon-people menu-icon"></i>
                <span class="menu-title">@lang('admin.Admins')</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{ Request::routeIs('admin.admins.*') || Request::routeIs('admin.roles.*') ? 'show' : '' }}"
                id="admins-elements">
                <ul class="nav flex-column sub-menu">
                    @if (can('admins.index'))
                    <li class="nav-item {{ Request::routeIs('admin.admins.*') ? 'activeItem' : '' }}">
                        <a class="nav-link" href="{{ route('admin.admins.index') }}">
                            @lang('admin.Admins')
                        </a>
                    </li>
                    @endif

                    @if (can('roles.index'))
                    <li class="nav-item {{ Request::routeIs('admin.roles.*') ? 'activeItem' : '' }}">
                        <a class="nav-link" href="{{ route('admin.roles.index') }}">
                            @lang('admin.Roles')
                        </a>
                    </li>
                    @endif

                </ul>
            </div>
        </li>
        @endif

        @if (can('settings.index'))
        <li class="nav-item {{ Request::routeIs('admin.settings.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.settings.index') }}">
                <i class="icon-cog menu-icon"></i>
                <span class="menu-title">@lang('admin.Settings') </span>
            </a>
        </li>
        @endif

        @if (can('services.index'))
        <li class="nav-item {{ Request::routeIs('admin.services.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.services.index') }}">
                <i class="icon-star menu-icon"></i>
                <span class="menu-title">@lang('admin.Services') </span>
            </a>
        </li>
        @endif
        <!---->
        @if (can('services.index'))
        <li class="nav-item {{ Request::routeIs('admin.privacy.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.privacy.index') }}">
                <i class="icon-user menu-icon"></i>
                <span class="menu-title">@lang('admin.privacy') </span>
            </a>
        </li>
        @endif





        <!---->

        @if (can('counters.index'))
        <li class="nav-item {{ Request::routeIs('admin.counters.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.counters.index') }}">
                <i class="icon-calculator menu-icon"></i>
                <span class="menu-title">@lang('admin.Counters') </span>
            </a>
        </li>
        @endif

        @if (can('clients.index'))
        <li class="nav-item {{ Request::routeIs('admin.clients.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.clients.index') }}">
                <i class="icon-people menu-icon"></i>
                <span class="menu-title">@lang('admin.Clients') </span>
            </a>
        </li>
        @endif

        @if (can('about.index'))
        <li class="nav-item {{ Request::routeIs('admin.about.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.about.index') }}">
                <i class="icon-info menu-icon"></i>
                <span class="menu-title">@lang('admin.About') </span>
            </a>
        </li>
        @endif

        @if (can('objectives.index'))
        <li class="nav-item {{ Request::routeIs('admin.objectives.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.objectives.index') }}">
                <i class="icon-fire menu-icon"></i>
                <span class="menu-title">@lang('admin.Objectives') </span>
            </a>
        </li>
        @endif

        @if (can('company-services.index'))
        <li class="nav-item {{ Request::routeIs('admin.company-services.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.company-services.index') }}">
                <i class="icon-layers menu-icon"></i>
                <span class="menu-title">@lang('admin.CompanyServices') </span>
            </a>
        </li>
        @endif

        @if (can('companies.index'))
        <li class="nav-item {{ Request::routeIs('admin.companies.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.companies.index') }}">
                <i class="icon-ghost menu-icon"></i>
                <span class="menu-title">@lang('admin.Companies') </span>
            </a>
        </li>
        @endif
        @if (can('types.index') || can('goals.index') || can('entities.index') || can('usages.index'))
        <li
            class="nav-item {{ Request::routeIs('admin.types.*') || Request::routeIs('admin.entities.*') || Request::routeIs('admin.goals.*') || Request::routeIs('admin.usages.*') ? 'active' : '' }}">
            <a class="nav-link" data-bs-toggle="collapse" href="#categories-elements" aria-expanded="false"
                aria-controls="categories-elements">
                <i class="icon-equalizer menu-icon"></i>
                <span class="menu-title">@lang('admin.Categories')</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{ Request::routeIs('admin.types.*') || Request::routeIs('admin.entities.*') || Request::routeIs('admin.goals.*') || Request::routeIs('admin.usages.*') ? 'show' : '' }}"
                id="categories-elements">
                <ul class="nav flex-column sub-menu">
                    @if (can('goals.index'))

                    <li class="nav-item {{ Request::routeIs('admin.goals.*') ? 'activeItem' : '' }}">
                        <a class="nav-link" href="{{ route('admin.goals.index') }}">
                            @lang('admin.Goals')
                        </a>
                    </li>
                    @endif
                    @if (can('entities.index'))

                    <li class="nav-item {{ Request::routeIs('admin.entities.*') ? 'activeItem' : '' }}">
                        <a class="nav-link" href="{{ route('admin.entities.index') }}">
                            @lang('admin.Entities')
                        </a>
                    </li>
                    @endif
                    @if (can('usages.index'))

                    <li class="nav-item {{ Request::routeIs('admin.usages.*') ? 'activeItem' : '' }}">
                        <a class="nav-link" href="{{ route('admin.usages.index') }}">
                            @lang('admin.Usages')
                        </a>
                    </li>
                    @endif
                    @if (can('types.index'))

                    <li class="nav-item {{ Request::routeIs('admin.types.*') ? 'activeItem' : '' }}">
                        <a class="nav-link" href="{{ route('admin.types.index') }}">
                            @lang('admin.Types')
                        </a>
                    </li>
                    @endif


                </ul>
            </div>
        </li>
        @endif
        <!---->
        @if (can('admins.index'))
        <li class="nav-item {{ Request::routeIs('admin.backup_database.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.backup_database') }}">
                <i class="icon-list download-icon"></i>
                <span class="menu-title">@lang('admin.download_database') </span>
            </a>
        </li>
        @endif


        <!---->

    </ul>
</nav>