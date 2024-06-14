@extends('admin.layouts.master')

@section('title', 'Departement Home')

@section('content')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">tasks</h4><span class="text-muted mt-1 tx-13 ml-2 mb-0">/
                    Index</span>
            </div>
        </div>
        @can('create task')
            <div class="d-flex my-xl-auto right-content">
                <div class="pr-1 mb-3 mb-xl-0">
                    <a href="{{ route('admin.tasks.create') }}" title="Add New Task" type="button" class="btn btn-info btn-sm">
                        <i class="fa-solid fa-plus"></i>
                    </a>
                </div>
            </div>
        @endcan
    </div>
    <!-- breadcrumb -->

    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12">
            <!--div-->
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.tasks.index') }}" method="get" id="attendanceForm">
                        {{-- @csrf --}}
                        <div class="row row-sm">
                            <div class="col-2">
                                <input class="form-control" type="date" name="date"
                                    value="{{ request()->has('date') ? request()->date : '' }}">
                            </div>
                            <div class="col-3">
                                <input class="form-control" type="text" name="employee_name" placeholder="employee name"
                                    value="{{ request()->has('employee_name') ? request()->employee_name : '' }}">
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
                                "{{ route('admin.excel.ExportTasks') }}");

                            document.getElementById("attendanceForm").submit();

                            setTimeout(function() {
                                document.getElementById("attendanceForm").setAttribute("action",
                                    "{{ route('admin.tasks.index') }}");
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
                                    <th>ID</th>
                                    <th>Nom Prenom</th>
                                    <th>Travail</th>
                                    <th>date debut</th>
                                    <th>date fin</th>
                                    <th>avancement</th>
                                    <th>Link</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <th scope="row">{{ $item->id }}</th>
                                        <td>{{ $item->employee->full_name }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->date_debut }}</td>
                                        <td>{{ $item->date_fin }}</td>
                                        <td>
                                            @if ($item->status == 1)
                                                <span class="badge bg-info text-white">start</span>
                                            @elseif ($item->status == 2)
                                                <span class="badge bg-warning text-white">on work</span>
                                            @else
                                                <span class="badge bg-success text-white">completed</span>
                                            @endif
                                        </td>
                                        <td><a href="{{ $item->link }}" target="__blank"
                                                class="btn btn-success btn-sm">click me</a></td>
                                        <td class="d-flex">
                                            @can("edit task")
                                                <a href="{{ route('admin.tasks.edit', $item) }}" class="btn btn-warning btn-sm"
                                                    style="margin-right: 5px"><i class="fa-solid fa-pen "></i></a>
                                            @endcan
                                            {{--  --}}
                                            <div class="btn-group dropdown">
                                                <button type="button"
                                                    class="btn btn-sm btn-success dropdown-toggle dropdown-toggle-split"
                                                    id="dropdownMenuDate" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right"
                                                    aria-labelledby="dropdownMenuDate" data-x-placement="bottom-end">
                                                    <a class="dropdown-item"
                                                        href="{{ route('admin.switch.SwitchTaskStatus', ['task' => $item, 'status' => 1]) }}">Start</a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('admin.switch.SwitchTaskStatus', ['task' => $item, 'status' => 2]) }}">On
                                                        Travail</a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('admin.switch.SwitchTaskStatus', ['task' => $item, 'status' => 3]) }}">Completed</a>
                                                </div>
                                            </div>
                                            {{--  --}}
                                            @can("delete task")
                                                
                                                <form action="{{ route('admin.tasks.destroy', $item) }}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button
                                                        onclick="return confirm('Are you sure you want to delete this item?');"
                                                        class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>
                                                </form>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center">

                {{ $data->links() }}
            </div>
        </div>
        <!--/div-->
    </div>
    <!-- /row -->
@endsection
