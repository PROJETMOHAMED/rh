@extends('admin.layouts.master')

@section('title', 'Departement Home')

@section('content')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Employees</h4>
                @if (Request()->has('status'))
                    <span class="text-muted mt-1 tx-13 ml-2 mb-0">/
                        {{ Request()->status == 1 ? 'Termine' : (Request()->status == 2 ? 'Abandone' : 'en cours') }}
                    </span>
                @endif
                @if (Request()->has('type'))
                    <span class="text-muted mt-1 tx-13 ml-2 mb-0">/
                        {{ Request()->type }}
                    </span>
                @endif
            </div>
        </div>
        <div class="d-flex my-xl-auto right-content">
            @can('create employee')
                <div class="pr-1 mb-3 mb-xl-0">
                    <a href="{{ route('admin.employees.create') }}" type="button" class="btn btn-info">
                        Add New Employee
                    </a>
                </div>
            @endcan
            <div class="pr-1 mb-3 mb-xl-0">
                <a href="{{ route('admin.excel.ExportEmployees') }}" type="button" class="btn btn-success">
                    <i class="fa-solid fa-file-csv"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12">
        <!--div-->
        <div class="card">
            <div class="card-body">
                <div class="main-content-label mg-b-5">
                    Filter By Departement
                </div>
                <form action="{{ route('admin.employees.index') }}" method="get">
                    {{-- @csrf --}}
                    <input type="hidden" name="type" value="{{ Request()->type }}">
                    <div class="row row-sm">
                        <div class="col-lg">
                            <select name="departement" class="form-control SlectBox SumoUnder">
                                @foreach (\App\Models\Departement::all() as $item)
                                    <option value="{{ $item->id }}" @selected($item->id == Request()->departement)>
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg">
                            <input class="btn btn-success" type="submit" value="Submit">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->

    <!-- row opened -->
    <div class="row row-sm">

        <!--div-->
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 text-md-nowrap">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Hiring Date</th>
                                    <th>phone</th>
                                    <th>sexe</th>
                                    <th>Departemt</th>
                                    <th>Contract</th>
                                    <th>piece identite</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    @php
                                        $status = '';
                                    @endphp
                                    <tr>
                                        <td>{{ $item->full_name }}</td>
                                        <td>{{ $item->date_debut }}</td>
                                        <td>{{ $item->phone }}</td>
                                        <td>{{ $item->sexe }}</td>
                                        <td>{{ $item->Departement->name }}</td>
                                        <td>{{ $item->ContratType->name }}</td>
                                        <td>{{ $item->piece_identite }}</td>
                                        <td>
                                            @can('edit employee')
                                                <a href="{{ route('admin.employees.edit', $item) }}"
                                                    class="btn btn-warning btn-sm"><i class="fa-solid fa-pen"></i></a>
                                            @endcan

                                            @can('view employee')
                                                <a href="{{ route('admin.employees.show', $item) }}"
                                                    class="btn btn-primary btn-sm"><i class="fa-solid fa-eye"></i></a>
                                            @endcan
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
                                                        href="{{ route('admin.switch.employee', ['employee' => $item, 'status' => 1]) }}">Termine</a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('admin.switch.employee', ['employee' => $item, 'status' => 2]) }}">Abandone</a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('admin.switch.employee', ['employee' => $item, 'status' => 3]) }}">en
                                                        Cours</a>
                                                </div>
                                            </div>
                                            @can('delete employee')
                                                @if ($item->Attendance->count() === 0 && $item->Tasks->Count() === 0)
                                                    <form id="delete-employee-form-{{ $item->id }}"
                                                        action="{{ route('admin.employees.destroy', $item) }}" method="POST"
                                                        style="display: none;">
                                                        @csrf
                                                        @method('delete')
                                                    </form>
                                                    <button onclick="confirmEmployeeDelete({{ $item->id }});"
                                                        class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>

                                                    <script>
                                                        function confirmEmployeeDelete(itemId) {
                                                            Swal.fire({
                                                                title: "Are you sure?",
                                                                text: "You won't be able to revert this!",
                                                                icon: "warning",
                                                                showCancelButton: true,
                                                                confirmButtonColor: "#3085d6",
                                                                cancelButtonColor: "#d33",
                                                                confirmButtonText: "Yes, delete it!"
                                                            }).then((result) => {
                                                                if (result.isConfirmed) {
                                                                    document.getElementById('delete-employee-form-' + itemId).submit();
                                                                }
                                                            });
                                                        }
                                                    </script>
                                                @endif
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $data->links() }}
                </div>
            </div>
        </div>
        <!--/div-->
    </div>
    <!-- /row -->
@endsection
