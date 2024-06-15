@if ($data->count() > 0)
    <div class="dropdown nav-item main-header-message ">
        <a class="new nav-link" href="#">
            <svg xmlns="http://www.w3.org/2000/svg" class="header-link-icon" height="24px" viewBox="0 0 24 24"
                width="24px" fill="currentColor">
                <path d="M0 0h24v24H0V0z" fill="none"></path>
                <path
                    d="M22 6c0-1.1-.9-2-2-2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6zm-2 0l-8 5-8-5h16zm0 12H4V8l8 5 8-5v10z">
                </path>
            </svg>
            <span class="position-absolute text-white top-0 start-100 translate-middle badge rounded-pill bg-danger">
                {{ $data->count() }}
            </span> </a>
        <div class="dropdown-menu">
            <div class="menu-header-content bg-primary text-left">
                <div class="d-flex">
                    <h6 class="dropdown-title mb-1 tx-15 text-white font-weight-semibold">Employess Near date fin</h6>
                </div>
                <p class="dropdown-title-text subtext mb-0 text-white op-6 pb-0 tx-12 ">Ther is {{ $data->count() }}
                    Near to End</p>
            </div>
            <div class="main-message-list chat-scroll">
                @foreach ($data as $item)
                    <a href="{{ route('admin.employees.show', $item) }}" class="p-3 d-flex border-bottom">
                        <div class="wd-90p">
                            <div class="d-flex">
                                <h5 class="mb-1 name">{{ $item->full_name }}</h5>
                            </div>
                            <p class="time mb-0 text-left float-left ml-2 mt-2">{{ $item->date_fin }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
            <div class="text-center dropdown-footer">
                <a href="#">VIEW ALL</a>
            </div>
        </div>
    </div>
@endif
