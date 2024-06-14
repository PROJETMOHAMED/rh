@extends('admin.layouts.master')

@section('title', 'profile')

@section('content')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Pages</h4><span class="text-muted mt-1 tx-13 ml-2 mb-0">/
                    Edit-Profile</span>
            </div>
        </div>
        <div class="d-flex my-xl-auto right-content">
            <div class="pr-1 mb-3 mb-xl-0">
                <button type="button" class="btn btn-info btn-icon mr-2"><i class="mdi mdi-filter-variant"></i></button>
            </div>
            <div class="pr-1 mb-3 mb-xl-0">
                <button type="button" class="btn btn-danger btn-icon mr-2"><i class="mdi mdi-star"></i></button>
            </div>
            <div class="pr-1 mb-3 mb-xl-0">
                <button type="button" class="btn btn-warning  btn-icon mr-2"><i class="mdi mdi-refresh"></i></button>
            </div>
            <div class="mb-3 mb-xl-0">
                <div class="btn-group dropdown">
                    <button type="button" class="btn btn-primary">14 Aug 2019</button>
                    <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                        id="dropdownMenuDate" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate"
                        data-x-placement="bottom-end">
                        <a class="dropdown-item" href="#">2015</a>
                        <a class="dropdown-item" href="#">2016</a>
                        <a class="dropdown-item" href="#">2017</a>
                        <a class="dropdown-item" href="#">2018</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->

    <!-- row -->
    <div class="row row-sm">
        <!-- Col -->
        <div class="col-lg-4">
            <div class="card mg-b-20">
                <div class="card-body">
                    <div class="pl-0">
                        <div class="main-profile-overview">
                            <div class="main-img-user profile-user">
                                <img alt=""
                                    src="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Ficon-library.com%2Fimages%2Fdefault-user-icon%2Fdefault-user-icon-3.jpg&f=1&nofb=1&ipt=3ef62c835b40da152fda723e6bb14e8fa2f6f11c6ce5ec2d7909b0410bbfb47d&ipo=images"><a
                                    class="fas fa-camera profile-edit" href="JavaScript:void(0);"></a>
                            </div>
                            <div class="d-flex justify-content-between mg-b-20">
                                <div>
                                    <h5 class="main-profile-name">{{ Auth::user()->name }}</h5>
                                    <p class="main-profile-name-text">
                                        @foreach (Auth::user()->roles as $item)
                                            {{ $item->name }}
                                        @endforeach
                                    </p>
                                </div>
                            </div>
                        </div><!-- main-profile-overview -->
                    </div>
                </div>
            </div>
        </div>

        <!-- Col -->
        <div class="col-lg-8">
            <div class="card">
                <form class="form-horizontal" action="{{ route('admin.profile.UpdateProfile') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="mb-4 main-content-label">Personal Information</div>
                        {{-- <div class="mb-4 main-content-label">Name</div> --}}
                        <div class="form-group ">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label">User Name</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" name="name" class="form-control"
                                        value="{{ Auth::user()->name }}" placeholder="User Name">
                                </div>
                                <div class="col-md-3"></div>
                                <div class="col-md-9">
                                    @error('name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group ">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label">Email</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" placeholder="email" name="email"
                                        value="{{ Auth::user()->email }}">
                                </div>
                                <div class="col-md-3"></div>
                                <div class="col-md-9">
                                    @error('email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Update Profile</button>
                    </div>
                </form>
            </div>
            <div class="card">
                <form class="form-horizontal" action="{{ route('admin.profile.resetPassword') }}" method="POST">
                    @csrf
                    {{-- @method("post") --}}
                    <div class="card-body">
                        <div class="mb-4 main-content-label">Change Password</div>
                        {{-- <div class="mb-4 main-content-label">Name</div> --}}
                        <div class="form-group ">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label">New Password</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="password" name="new_password" class="form-control"
                                        placeholder="password">
                                </div>
                                <div class="col-md-3"></div>
                                <div class="col-md-9">
                                    @error('new_password')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group ">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label">Confirm Password</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="password" name="confirm_password" class="form-control"
                                        placeholder="confirm password">
                                </div>
                                <div class="col-md-3"></div>
                                <div class="col-md-9">
                                    @error('confirm_password')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Update Password</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /Col -->
    </div>
    <!-- row closed -->
@endsection
