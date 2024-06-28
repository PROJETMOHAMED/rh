@extends('admin.layouts.master')


@section('title', 'Appointement Check')

@section('content')

    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12">
            <!--div-->
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.att.ViewAttendance') }}" method="get" id="attendanceForm">
                        {{-- @csrf --}}
                        <div class="row row-sm">
                            <div class="col-2">
                                <input class="form-control" type="date" name="date_debut"
                                    value="{{ request()->has('date_debut') ? request()->date_debut : $dates[0] }}">
                            </div>
                            <div class="col-2">
                                <input class="form-control" type="date" name="date_fin"
                                    value="{{ request()->has('date_fin') ? request()->date_fin : end($dates) }}">
                            </div>
                            <div class="col-3">
                                <input class="form-control" type="text" name="employee_name"
                                    value="{{ request()->has('employee_name') ? request()->employee_name : '' }}">
                            </div>
                            <div class="col-3">
                                <select name="departement_id" class="form-control SlectBox SumoUnder">
                                    <option value=""></option>
                                    @foreach ($departements as $item)
                                        <option value="{{ $item->id }}"
                                            {{ request()->departement_id == $item->id ? 'selected' : '' }}>
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-2">
                                <button type="submit" class="btn btn-success"><i
                                        class="fa-solid fa-magnifying-glass"></i></button>
                                <button class="btn btn-primary" id="exportExcel"><i
                                        class="fa-solid fa-file-csv"></i></button>

                            </div>
                        </div>
                    </form>
                    <script>
                        document.getElementById("exportExcel").addEventListener("click", function() {
                            var formData = new FormData(document.getElementById("attendanceForm"));

                            for (var pair of formData.entries()) {
                                var hiddenInput = document.createElement("input");
                                hiddenInput.setAttribute("type", "hidden");
                                hiddenInput.setAttribute("name", pair[0]);
                                hiddenInput.setAttribute("value", pair[1]);
                                document.getElementById("attendanceForm").appendChild(hiddenInput);
                            }

                            document.getElementById("attendanceForm").setAttribute("action",
                                "{{ route('admin.excel.ExportEmployeesAttendance') }}");

                            document.getElementById("attendanceForm").submit();

                            setTimeout(function() {
                                document.getElementById("attendanceForm").setAttribute("action",
                                    "{{ route('admin.att.ViewAttendance') }}");
                            }, 5000);

                        });
                    </script>
                </div>
            </div>
        </div>
        <!--div-->
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 text-md-nowrap">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Position</th>
                                    @foreach ($dates as $date)
                                        <th>{{ $date }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employees as $employee)
                                    <tr>
                                        <td>{{ $employee->full_name }}</td>
                                        <td>{{ $employee->Departement->name }}</td>
                                        @foreach ($dates as $date)
                                            @php
                                                $date_picker = $date;
                                                $check_attd = \App\Models\Attendance::query()
                                                    ->where('employee_id', $employee->id)
                                                    ->where('date', $date_picker)
                                                    ->first();
                                            @endphp
                                            <td>
                                                @if ($check_attd)
                                                    @if ($check_attd->status == 1)
                                                        {{ $check_attd->status }}
                                                        <div class="btn-group dropdown">
                                                            <button type="button" class="badge bg-danger"
                                                                style="border: none" id="dropdownMenuDate"
                                                                data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                                <i class="fa-solid fa-x"
                                                                    title="{{ $check_attd->reason }}"></i>
                                                                <span class="sr-only">Toggle Dropdown</span>
                                                            </button>
                                                            <div class="dropdown-menu dropdown-menu-right"
                                                                aria-labelledby="dropdownMenuDate"
                                                                data-x-placement="bottom-end">
                                                                <a href="{{ route('admin.switch.SwitchAttendanceStatus', ['attendance' => $check_attd, 'status' => 2]) }}"
                                                                    class="dropdown-item">retard</a>
                                                                <a class="dropdown-item"
                                                                    href="{{ route('admin.switch.SwitchAttendanceStatus', ['attendance' => $check_attd, 'status' => 3]) }}">absent
                                                                    aprés midi</a>
                                                                <a href="{{ route('admin.switch.SwitchAttendanceStatus', ['attendance' => $check_attd, 'status' => 0]) }}"
                                                                    class="dropdown-item">preson</a>
                                                            </div>
                                                        </div>
                                                    @elseif ($check_attd->status == 3)
                                                        {{ $check_attd->status }}
                                                        <div class="btn-group dropdown">
                                                            <button type="button" class="badge bg-warning"
                                                                style="border: none" id="dropdownMenuDate"
                                                                data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                                <i
                                                                    class="fa-solid fa-exclamation"title="{{ $item->reason }}"></i>
                                                                <span class="sr-only">Toggle Dropdown</span>
                                                            </button>
                                                            <div class="dropdown-menu dropdown-menu-right"
                                                                aria-labelledby="dropdownMenuDate"
                                                                data-x-placement="bottom-end">
                                                                <a href="{{ route('admin.switch.SwitchAttendanceStatus', ['attendance' => $check_attd, 'status' => 2]) }}"
                                                                    class="dropdown-item">retard</a>
                                                                <a class="dropdown-item"
                                                                    href="{{ route('admin.switch.SwitchAttendanceStatus', ['attendance' => $check_attd, 'status' => 1]) }}">absent</a>
                                                                <a href="{{ route('admin.switch.SwitchAttendanceStatus', ['attendance' => $check_attd, 'status' => 0]) }}"
                                                                    class="dropdown-item">preson</a>
                                                            </div>
                                                        </div>
                                                        @else
                                                        {{ $check_attd->status }}
                                                        <div class="btn-group dropdown">
                                                            <button type="button" class="badge bg-info"
                                                            style="border: none" id="dropdownMenuDate"
                                                            data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                                <i title="{{ $check_attd->reason }}"
                                                                    class="fa-solid fa-minus"></i>
                                                                <span class="sr-only">Toggle Dropdown</span>
                                                            </button>
                                                            <div class="dropdown-menu dropdown-menu-right"
                                                                aria-labelledby="dropdownMenuDate"
                                                                data-x-placement="bottom-end">
                                                                <a class="dropdown-item"
                                                                    href="{{ route('admin.switch.SwitchAttendanceStatus', ['attendance' => $check_attd, 'status' => 3]) }}">absent
                                                                    aprés midi</a>
                                                                <a class="dropdown-item"
                                                                    href="{{ route('admin.switch.SwitchAttendanceStatus', ['attendance' => $check_attd, 'status' => 1]) }}">absent</a>
                                                                <a class="dropdown-item"
                                                                    href="{{ route('admin.switch.SwitchAttendanceStatus', ['attendance' => $check_attd, 'status' => 0]) }}">preson</a>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @else
                                                    <span class="badge bg-success" title="check"><i
                                                            class="fa-solid fa-check"></i></span>
                                                @endif
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>


                    </div>
                </div>
            </div>
        </div>
        <!--/div-->
    </div>
    <!-- /row -->
@endsection
