@extends('admin.layouts.master')

@section('title', 'Departement Home')

@section('content')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Bloc Notes</h4><span class="text-muted mt-1 tx-13 ml-2 mb-0">/
                    Index</span>
            </div>
        </div>
        @can('create note')
            <div class="d-flex my-xl-auto right-content">
                <div class="pr-1 mb-3 mb-xl-0">
                    <a href="{{ route('admin.notes.create') }}" title="Add New Bloc Note" type="button"
                        class="btn btn-info btn-sm">
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
                    <form action="{{ route('admin.notes.index') }}" method="get" id="attendanceForm">
                        {{-- @csrf --}}
                        <div class="row row-sm">
                            <div class="col-2">
                                <input class="form-control" type="date" name="date"
                                    value="{{ request()->has('date') ? request()->date : '' }}">
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
                                "{{ route('admin.excel.ExportNotes') }}");

                            document.getElementById("attendanceForm").submit();

                            setTimeout(function() {
                                document.getElementById("attendanceForm").setAttribute("action",
                                    "{{ route('admin.notes.index') }}");
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
                                    <th>*</th>
                                    <th>Date</th>
                                    <th>Note</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <th scope="row">{{ $item->id }}</th>
                                        <td>{{ $item->date }}</td>
                                        <td>@limitHtml($item->description)</td>
                                        <td class="d-flex">
                                            @can('edit note')
                                                <a href="{{ route('admin.notes.edit', $item) }}" class="btn btn-warning btn-sm"
                                                    style="margin-right: 5px"><i class="fa-solid fa-pen "></i></a>
                                            @endcan

                                            <a href="{{ route('admin.notes.show', $item) }}" style="margin-right: 5px"
                                                class="btn btn-primary btn-sm"><i class="fa-solid fa-eye"></i></a> 

                                            @can('delete note')
                                                <form id="delete-form-{{ $item->id }}"
                                                    action="{{ route('admin.notes.destroy', $item) }}" method="POST"
                                                    style="display: none;">
                                                    @csrf
                                                    @method('delete')
                                                </form>
                                                <button onclick="confirmDelete({{ $item->id }});"
                                                    class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>

                                                <script>
                                                    function confirmDelete(itemId) {
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
                                                                document.getElementById('delete-form-' + itemId).submit();
                                                                Swal.fire({
                                                                    title: "Deleted!",
                                                                    text: "Your file has been deleted.",
                                                                    icon: "success"
                                                                });
                                                            }
                                                        });
                                                    }
                                                </script>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
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
