@extends('admin.layouts.master')

@section('title', 'Update Task')

@section('content')
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="main-content-label mg-b-5">
                    Edit Note
                </div>
                <form action="{{route('admin.notes.update' , $note)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row row-sm">
                        <div class="col-6">
                            <div class="form-group mg-b-0">
                                <label class="form-label">Date: <span class="tx-danger">*</span></label>
                                <input class="form-control" name="date" required="" value="{{ $note->date }}"
                                    type="date" />
                                @error('date')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- Task link -->
                        <div class="col-12">
                            <div class="form-group mg-b-0">
                                <label class="form-label">description : <span class="tx-danger">*</span></label>
                                <textarea name="description" id="" class="form-control" cols="30" rows="10">{{ $note->description }}</textarea>
                                @error('description')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- Submit button -->
                        <div class="col-12">
                            <button class="btn btn-main-primary pd-x-20 mg-t-10" type="submit">
                                Create Bloc Note
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
