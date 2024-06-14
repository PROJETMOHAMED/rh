@extends('admin.layouts.master')

@section('title', 'employee details')

@section('content')

    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Profile</h4><span class="text-muted mt-1 tx-13 ml-2 mb-0">/
                    {{ $employee->full_name }}</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->

    @if ($errors->has('time'))
        <span class="text-danger">
            {{ $errors->first('time') }}
        </span>
    @endif


    <!-- row -->
    <div class="row row-sm">
        <div class="col-lg-4">
            <div class="card mg-b-20">
                <div class="card-body">
                    <div class="pl-0">
                        <div class="main-profile-overview">
                            <div class="d-flex justify-content-between mg-b-20">
                                <div>
                                    <h5 class="main-profile-name">{{ $employee->fullName }}</h5>
                                    <p class="main-profile-name-text">{{ $employee->Departement->name }}</p><br>
                                    <h5 class="main-profile-name">{{ $employee->email }}</h5>
                                    <h5 class="main-profile-name">{{ $employee->ContratType->name }}</h5>
                                </div>
                            </div>
                            <hr class="mg-y-30">
                            <div>
                                <h5 class="main-profile-name">Start AT : {{ $employee->date_debut }}</h5>
                                @if ($employee->date_fin)
                                    <h5 class="main-profile-name">End AT : {{ $employee->date_fin }}</h5>
                                @else
                                    <h5 class="main-profile-name">Non specifié</h5>
                                @endif
                            </div><br>
                            <hr class="mg-y-30">
                            <a href="{{ route('admin.excel.GetRetardAbsenceOfEmployee', $employee) }}"
                                class="btn btn-primary waves-effect waves-light w-md">Export Data</a>
                            @if (now() > $employee->date_fin)
                                <a href="{{ route('admin.excel.GetEmployeeRaport', $employee) }}"
                                    class="btn btn-success waves-effect waves-light w-md text-white">Get Rapport</a>
                            @endif
                        </div><!-- main-profile-overview -->
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="tabs-menu ">
                        <!-- Tabs -->
                        <ul class="nav nav-tabs profile navtab-custom panel-tabs">
                            @can('view attendance')
                                <li class="active">
                                    <a href="#home" data-toggle="tab" aria-expanded="true"> <span class="visible-xs"><i
                                                class="las la-user-circle tx-16 mr-1"></i></span> <span
                                            class="hidden-xs">Attendance</span> </a>
                                </li>
                            @endcan
                            @can('add attendance')
                                <li class="">
                                    <a href="#profile" data-toggle="tab" aria-expanded="false"> <span class="visible-xs"><i
                                                class="las la-images tx-15 mr-1"></i></span> <span class="hidden-xs">Create
                                            Att</span> </a>
                                </li>
                            @endcan
                            <li class="">
                                <a href="#tasks" data-toggle="tab" aria-expanded="true"> <span class="visible-xs"><i
                                            class="las la-cog tx-16 mr-1"></i></span> <span class="hidden-xs">tasks</span>
                                </a>
                            </li>
                            <li class="">
                                <a href="#createtask" data-toggle="tab" aria-expanded="true"> <span class="visible-xs"><i
                                            class="las la-cog tx-16 mr-1"></i></span> <span class="hidden-xs">Create
                                        task</span> </a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content border-left border-bottom border-right border-top-0 p-4">
                        <div class="tab-pane active" id="home">
                            @can('view attendance')
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0 text-md-nowrap">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>date</th>
                                                <th>reason</th>
                                                <th>justification</th>
                                                <th>status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($employee->Attendance as $item)
                                                <tr>
                                                    <th scope="row">{{ $item->id }}</th>
                                                    <td>{{ $item->date }}</td>
                                                    <td>{{ $item->reason }}</td>
                                                    <td>
                                                        @if ($item->Files)
                                                            <a href=" {{ asset('files/AttendanceReason/' . $item->Files->url) }}"
                                                                target="_blank">
                                                                click me
                                                            </a>
                                                        @else
                                                            No Justis found
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($item->status == 1)
                                                            <span class="badge bg-danger" title="absence"><i
                                                                    class="fa-solid fa-x"></i></span>
                                                        @else
                                                            <span class="badge bg-warning" title="retard"><i
                                                                    class="fa-solid fa-minus"></i></span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @empty
                                                <h3>No Attendance Found</h3>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            @endcan
                        </div>
                        <div class="tab-pane" id="profile">

                            <h4>Create Attendance</h4>
                            <form action="{{ route('admin.att.CreateAttendance', $employee) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="FullName">Date</label>
                                    <input type="date" value="{{ now()->format('Y-m-d') }}" name="date"
                                        class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="Email">status : <span class="tx-danger">*</span></label>
                                    <select id="status" class="form-control SlectBox SumoUnder" name="status">
                                        <option value="1">Absence</option>
                                        <option value="2">retard</option>
                                    </select>
                                </div>
                                <div class="form-group" id="timeDiv" style="display: none;">
                                    <label for="Username">Time :</label>
                                    <?php
                                    $current_time = date('H:i:s');
                                    $new_time = date('H:i:s', strtotime($current_time . ' +1 hour'));
                                    ?>
                                    <input type="time" name="time" value="{{ $new_time }}" id="Username"
                                        class="form-control">
                                </div>

                                <script>
                                    document.getElementById('status').addEventListener('change', function() {
                                        var timeDiv = document.getElementById('timeDiv');
                                        if (this.value == 1) {
                                            timeDiv.style.display = 'none';
                                        } else {
                                            timeDiv.style.display = 'block';
                                        }
                                    });
                                </script>
                                <div class="form-group">
                                    <label for="Username">Reason :<span class="tx-danger">*</span></label>
                                    <input type="text" name="reason" id="Username" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="Username">Justification</label>
                                    <input type="file" name="file" class="form-control" accept="application/pdf">
                                </div>
                                <button class="btn btn-primary waves-effect waves-light w-md" type="submit">Save</button>
                            </form>
                        </div>
                        <div class="tab-pane" id="tasks">
                            <h3 class="text-center">{{ $employee->full_name }} Tasks</h3>
                            <table class="table table-hover mb-0 text-md-nowrap">
                                <thead>
                                    <tr>
                                        <th>task</th>
                                        <th>debut</th>
                                        <th>fin</th>
                                        <th>status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($employee->Tasks as $item)
                                        <tr>
                                            <th scope="row">{{ $item->name }}</th>
                                            <td>{{ $item->date_debut }}</td>
                                            <td>{{ $item->date_debut }}</td>
                                            <td>{{ $item->reason }}</td>
                                            <td>
                                                {{-- @if ($item->status == 1)
                                                    <span class="badge bg-danger" title="absence"><i
                                                            class="fa-solid fa-x"></i></span>
                                                @else
                                                    <span class="badge bg-warning" title="retard"><i
                                                            class="fa-solid fa-minus"></i></span>
                                                @endif --}}
                                            </td>
                                        </tr>
                                    @empty
                                        <h3>No Task Found</h3>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="createtask">
                            <form action="{{ route('admin.tasks.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="employee_id" value="{{ $employee->id }}">
                                <input type="hidden" name="status" value="1">
                                <div class="form-group">
                                    <label for="FullName">Travail</label>
                                    <input type="text" value="{{ old('name') }}" name="name"
                                        class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="Email">date debut</label>
                                    <input type="date" name="date_debut" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="Email">date fin</label>
                                    <input type="date" name="date_fin" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="Username">Link</label>
                                    <input type="text" value="{{ old('link') }}" id="Username" name="link"
                                        class="form-control">
                                </div>
                                <button class="btn btn-primary waves-effect waves-light w-md" type="submit">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
