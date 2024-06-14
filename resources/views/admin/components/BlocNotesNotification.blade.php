@if ($data->count() > 0)
    <div class="dropdown nav-item main-header-message ">
        <a class="new nav-link" href="#"><svg xmlns="http://www.w3.org/2000/svg" class="header-link-icon" height="24px" viewBox="0 0 24 24" width="24px" fill="currentColor"><path d="M0 0h24v24H0V0z" fill="none"></path><path d="M12 22c1.1 0 2-.9 2-2h-4c0 1.1.9 2 2 2zm6-6v-5c0-3.07-1.63-5.64-4.5-6.32V4c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5v.68C7.64 5.36 6 7.92 6 11v5l-2 2v1h16v-1l-2-2zm-2 1H8v-6c0-2.48 1.51-4.5 4-4.5s4 2.02 4 4.5v6z"></path></svg><span class=" pulse-danger"></span></a>
        <div class="dropdown-menu">
            <div class="menu-header-content bg-primary text-left">
                <div class="d-flex">
                    <h6 class="dropdown-title mb-1 tx-15 text-white font-weight-semibold">Today Notes</h6>
                </div>
                <p class="dropdown-title-text subtext mb-0 text-white op-6 pb-0 tx-12 ">You have {{ $data->count() }}
                    Note For Today</p>
            </div>
            <div class="main-message-list chat-scroll">
                @foreach ($data as $item)
                    <a href="#" class="p-3 d-flex border-bottom">
                        <div class="wd-90p">
                            <div class="d-flex">
                                <h5 class="mb-1 name">{{ $item->description }}</h5>
                            </div>
                            <p class="time mb-0 text-left float-left ml-2 mt-2">{{ $item->date }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
            <div class="text-center dropdown-footer">
                <a href="{{route('admin.notes.index')}}">VIEW ALL</a>
            </div>
        </div>
    </div>
@endif
