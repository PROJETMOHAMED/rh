<!-- main-sidebar -->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar sidebar-scroll" >
    <div class="main-sidebar-header active">
        <a class="desktop-logo logo-light active" href="#"><img src="{{ asset('assets/img/brand/logo.png') }} "
                class="main-logo" alt="logo"></a>
        <a class="desktop-logo logo-dark active" href="#"><img
                src="{{ asset('assets/img/brand/logo-white.png') }} " class="main-logo dark-theme" alt="logo"></a>
        <a class="logo-icon mobile-logo icon-light active" href="#"><img
                src="{{ asset('assets/img/brand/favicon.png') }}" class="logo-icon" alt="logo"></a>
        <a class="logo-icon mobile-logo icon-dark active" href="#"><img
                src="{{ asset('assets/img/brand/favicon-white.png') }}" class="logo-icon dark-theme" alt="logo"></a>
    </div>
    <div class="main-sidemenu">
        <div class="app-sidebar__user clearfix">
            <div class="dropdown user-pro-body">
                <div class="">
                    <img alt="user-img" class="avatar avatar-xl brround"
                        src="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Ficon-library.com%2Fimages%2Fdefault-user-icon%2Fdefault-user-icon-3.jpg&f=1&nofb=1&ipt=3ef62c835b40da152fda723e6bb14e8fa2f6f11c6ce5ec2d7909b0410bbfb47d&ipo=images "><span
                        class="avatar-status profile-status bg-green"></span>
                </div>
                <div class="user-info">
                    <h4 class="font-weight-semibold mt-3 mb-0">{{ Auth::user()->name }}</h4>
                    <span class="mb-0 text-muted">
                        @foreach (Auth::user()->roles as $role)
                            {{ $role->name }}
                        @endforeach
                    </span>
                </div>
            </div>
        </div>
        <ul class="side-menu">
            <li class="side-item side-item-category">Main</li>
            <li class="slide">
                <a class="side-menu__item" href="{{ route('admin.home') }}"><svg xmlns="http://www.w3.org/2000/svg"
                        class="side-menu__icon" viewBox="0 0 24 24">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path d="M5 5h4v6H5zm10 8h4v6h-4zM5 17h4v2H5zM15 5h4v2h-4z" opacity=".3" />
                        <path
                            d="M3 13h8V3H3v10zm2-8h4v6H5V5zm8 16h8V11h-8v10zm2-8h4v6h-4v-6zM13 3v6h8V3h-8zm6 4h-4V5h4v2zM3 21h8v-6H3v6zm2-4h4v2H5v-2z" />
                    </svg><span class="side-menu__label" style="font-weight: bold">Acceuil</span></a>
            </li>

            <li class="side-item side-item-category">General</li>
            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="#"><i class="fa-solid fa-building"
                        style="color: #000000;"></i><span class="side-menu__label"
                        style="margin-left: 14px;font-weight: bold">Département</span><i class="angle fe fe-chevron-down"></i></a>
                <ul class="slide-menu">
                    @foreach ($departementlist as $item)
                        @if (Auth::user()->departements->contains('id', $item->id))
                            <li><a class="slide-item"
                                    href="{{ route('admin.departement.home', $item) }}">{{ $item->name }}</a></li>
                        @endif
                    @endforeach
                </ul>

            </li>
            @can('view employee')
                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="#"><i class="fa-solid fa-users"
                            style="color: #000000;"></i><span class="side-menu__label"
                            style="margin-left: 14px;font-weight: bold">Employés</span><i class="angle fe fe-chevron-down"></i></a>
                    <ul class="slide-menu">
                        <li><a class="slide-item" href="{{ route('admin.employees.index', ['status' => 3]) }}">en Cours</a>
                        </li>
                        <li><a class="slide-item" href="{{ route('admin.employees.index', ['status' => 1]) }}">Temine</a>
                        </li>
                        <li><a class="slide-item" href="{{ route('admin.employees.index', ['status' => 2]) }}">Abondon</a>
                        </li>
                    </ul>
                </li>
            @endcan
            @can('view attendance')
                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="#"><i class="fa-solid fa-user-check"
                            style="color: #000000;"></i><span class="side-menu__label"
                            style="margin-left: 14px;font-weight: bold">Présence</span><i class="angle fe fe-chevron-down"></i></a>
                    <ul class="slide-menu">
                        <li><a class="slide-item" href="{{ route('admin.att.ViewAttendance') }}">View Attendance</a></li>
                        <li><a class="slide-item" href="{{ route('admin.att.RetardAbence', ['status' => 2]) }}">Attendance
                                Retard</a></li>
                        <li><a class="slide-item" href="{{ route('admin.att.RetardAbence', ['status' => 1]) }}">Attendance
                                Absence</a></li>
                    </ul>
                </li>
            @endcan
            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="#"><i class="fa-solid fa-user-tie"
                        style="color: #000000;"></i><span class="side-menu__label"
                        style="margin-left: 14px;font-weight: bold">Personnel</span><i class="angle fe fe-chevron-down"></i></a>
                <ul class="slide-menu">
                    <li><a class="slide-item"
                            href="{{ route('admin.employees.index', ['type' => 'stage']) }}">Stagiaire</a></li>
                    <li><a class="slide-item"
                            href="{{ route('admin.employees.index', ['type' => 'Employment Contract']) }}">Employee</a>
                    </li>
                    <li><a class="slide-item"
                            href="{{ route('admin.employees.index') }}">Listing du personnel</a>
                    </li>
                </ul>
            </li>
            <li class="slide">
                <a class="side-menu__item" href="{{ route('admin.WorkTime') }}">
                        <i class="fa-solid fa-business-time" style="color: #000000;"></i>
                        <span style="margin-left: 14px;font-weight: bold"
                        class="side-menu__label">Schedules</span></a>
            </li>
            @can("view note")
                <li class="slide">
                    <a class="side-menu__item" href="{{ route('admin.notes.index') }}"><i class="fa-solid fa-book"
                            style="color: #000000;"></i><span style="margin-left: 14px;font-weight: bold"
                            class="side-menu__label">Notes</span></a>
                </li>
            @endcan
            @can("view task")
                <li class="slide">
                    <a class="side-menu__item" href="{{ route('admin.tasks.index') }}"><i class="fa-solid fa-list-check"
                            style="color: #000000;"></i><span style="margin-left: 14px;font-weight: bold"
                            class="side-menu__label">tasks</span></a>
                </li>
            @endcan
            @can("view user")
                <li class="slide">
                    <a class="side-menu__item" href="{{ route('admin.users.index') }}"><i class="fa-solid fa-user-gear"
                            style="color: #000000;"></i><span style="margin-left: 14px;font-weight: bold"
                            class="side-menu__label">users</span></a>
                </li>
            @endcan
            <li class="slide">
                <a class="side-menu__item" href="{{ route('admin.profile.index') }}"><i class="fa-solid fa-gears"
                        style="color: #000000;"></i><span style="margin-left: 14px;font-weight: bold"
                        class="side-menu__label">Profie</span></a>
            </li>
        </ul>
    </div>
</aside>