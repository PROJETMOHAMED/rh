@extends('admin.layouts.master')

@section('title', 'Create Departement')


@section('content')
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="main-content-label mg-b-5">
                    Create A New Contat Type
                </div>
                <form id="category_form" action="{{ route('admin.types.store') }}" method="POST">
                    @csrf
                    <div class="row row-sm">
                        <div class="col-6">
                            <div class="form-group mg-b-0">
                                <label class="form-label">name: <span class="tx-danger">*</span></label>
                                <input class="form-control" name="name" placeholder="Enter contat type name"
                                    required="" type="text" />
                                @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label">Select Parent <span class="tx-danger">(Optionel)</span></label>
                                <select name="parent_id" class="form-control SlectBox SumoUnder">
                                    <option value="">Optionel</option>
                                    @foreach ($types as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-12">
                            <button class="btn btn-main-primary pd-x-20 mg-t-10" type="submit">
                                Validate Form
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
@endsection

@section('scripts')

    {{-- <script>
        function GetData() {
            parent_id = document.getElementById("parent_id").value;
            $.ajax({
                url: "{{ route('api.GetChildren') }}",
                data: {
                    parentId: parent_id
                },
                type: "GET",
                success: function(response) {
                    if (response.status === 'success') {
                        // $('#availableTimes').empty();
                        $('#subType').show();
                        var subTypes = '';
                        response.forEach(function(item) {
                            subTypes +=
                                `
                                <option value="${item.id}">${item.name}
                                </option>;
                                `
                        });

                        document.getElementById('subType').innerHTML =
                            `
                        <select name="parent_id" class="form-control SlectBox SumoUnder"
                                    onchange="getData">${subTypes}</select>
                        `

                        ;

                    } else {
                        console.log(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    alert("An error occurred: " + error);
                }
            });
        }
    </script> --}}


@endsection
