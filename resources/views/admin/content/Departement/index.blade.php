@extends('admin.layouts.master')

@section('title', 'Departement Home')

@section('content')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Departement</h4><span class="text-muted mt-1 tx-13 ml-2 mb-0">/
                    {{ $departement->name }}</span>
            </div>
        </div>
        <div class="d-flex my-xl-auto right-content">
            <div class="pr-1 mb-3 mb-xl-0">
                <a href="{{ route('admin.departement.create') }}" title="AddNew Departement" type="button"
                    class="btn btn-info btn-sm">
                    <i class="fa-solid fa-plus"></i>
                </a>
            </div>
            <div class="pr-1 mb-3 mb-xl-0">
                <a href="{{ route('admin.departement.edit', $departement) }}" title="Edit Departement"
                    class="btn btn-warning btn-sm"><i class="fa-solid fa-pen"></i></a>
            </div>
            @if ($departement->Employee->count() == 0)
                <div class="pr-1 mb-3 mb-xl-0">
                    <form action="{{ route('admin.departement.destroy', $departement) }}" method="POST">
                        @csrf
                        @method('delete')
                        <button onclick="return confirm('Are you sure you want to delete this item?');"
                            title="Delete Departement" class="btn btn-danger btn-sm"><i
                                class="fa-solid fa-trash"></i></button>
                    </form>
                    {{-- <button type="button" ></button> --}}
                </div>
            @endif
            <div class="pr-1 mb-3 mb-xl-0">
                <a href="{{ route('admin.excel.ExportDepartement') }}" title="Export Departement data in excel Departement"
                    class="btn btn-secondary btn-sm"><i class="fa-solid fa-file-csv"></i></a>
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
                                    <th>Hiring Date</th>
                                    <th>phone</th>
                                    <th>Departemt</th>
                                    <th>Contract</th>
                                    <th>piece identite</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($departement->Employee as $item)
                                    <tr>
                                        <th scope="row">{{ $item->id }}</th>
                                        <td>{{ $item->full_name }}</td>
                                        <td>{{ $item->date_debut }}</td>
                                        <td>{{ $item->phone }}</td>
                                        <td>{{ $item->Departement->name }}</td>
                                        <td>{{ $item->ContratType->name }}</td>
                                        <td>{{ $item->piece_identite }}</td>
                                        <td class="d-flex">
                                            <a href="{{ route('admin.employees.edit', $item) }}"
                                                class="btn btn-warning btn-sm" style="margin-right: 5px"><i
                                                    class="fa-solid fa-pen "></i></a>
                                            <a href="{{ route('admin.employees.show', $item) }}" style="margin-right: 5px"
                                                class="btn btn-primary btn-sm"><i class="fa-solid fa-eye"></i></a>
                                            <form action="{{ route('admin.employees.destroy', $item) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button
                                                    onclick="return confirm('Are you sure you want to delete this item?');"
                                                    class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <h5 class="text-center">No Employee Found In {{ $departement->name }} Departement</h5>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{-- {{ $data->links() }} --}}
                </div>
            </div>
        </div>
        <!--/div-->
    </div>
    <!-- /row -->
@endsection
