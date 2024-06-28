@extends('admin.layouts.master')

@section('title', 'Departement Home')

@section('content')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Attendance </h4><span class="text-muted mt-1 tx-13 ml-2 mb-0">/
                    {{$status}} </span>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12">
        <!--div-->
        <div class="card">
            <div class="card-body">
                <div class="main-content-label mg-b-5">
                    Filter By Date
                </div>
                <form action="{{ route('admin.att.RetardAbence') }}" method="get">
                    {{-- @csrf --}}
                    <div class="row row-sm">
                        <div class="col-lg">
                            <input class="form-control" type="date" name="date_debut"
                                value="{{ request()->has('date_debut') ? request()->date_debut : now()->format('Y-m-d') }}">

                        </div>
                        <div class="col-lg">
                            <input class="form-control" type="date" name="date_fin"
                                value="{{ request()->has('date_fin') ? request()->date_fin : now()->format('Y-m-d') }}">
                        </div>
                        <div class="col-lg">
                            <input class="form-control" type="text" name="employee_name" value="{{ request()->has('employee_name') ? request()->employee_name : '' }}">

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
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>phone</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <th scope="row">{{ $item->id }}</th>
                                        <td>{{ $item->employee->full_name }}</td>
                                        <td>{{ $item->date }}</td>
                                        <td>{{ $item->employee->phone }}</td>
                                        <td class="row row-xs wd-xl-80p">
                                            {{-- <div class="col-sm-6 col-md-3 mg-sm-t-0">
                                                <a href="{{ route('admin.employees.edit', $item) }}"
                                                    class="btn btn-warning btn-block"><i class="fa-solid fa-pen"></i></a>
                                            </div> --}}
                                            <div class="col-sm-6 col-md-3 mg-sm-t-0">
                                                <a href="{{ route('admin.employees.show', $item) }}"
                                                    class="btn btn-primary btn-sm"><i class="fa-solid fa-eye"></i></a>
                                            </div>
                                            {{-- <form action="{{ route('admin.employees.destroy', $item) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button
                                                    onclick="return confirm('Are you sure you want to delete this item?');"
                                                    class="btn btn-danger btn-block"><i
                                                        class="fa-solid fa-trash"></i></button>
                                            </form> --}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <div class="mx-auto">

                    {{ $data->links() }}
                </div>
            </div>
        </div>
        <!--/div-->
    </div>
    <!-- /row -->
@endsection
