@extends('admin.layouts.master')

@section('title', 'Update Task')

@section('content')
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="main-content-label mg-b-5">
                    Update Task
                </div>
                <form action="{{ route('admin.tasks.update', $task->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="status" value="{{ $task->status }}">
                    <div class="row row-sm">
                        <!-- Employee name -->
                        <div class="col-6">
                            <div class="form-group mg-b-0">
                                <label class="form-label">Employee Name: <span class="tx-danger">*</span></label>
                                <select name="employee_id" class="form-control SlectBox SumoUnder">
                                    @foreach (\App\Models\Employee::all() as $employee)
                                        <option value="{{ $employee->id }}" {{ $task->employee_id == $employee->id ? 'selected' : '' }}>
                                            {{ $employee->full_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('employee_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- Task name -->
                        <div class="col-6">
                            <div class="form-group mg-b-0">
                                <label class="form-label">Task: <span class="tx-danger">*</span></label>
                                <input class="form-control" name="name" placeholder="Enter task name" required=""
                                    value="{{ $task->name }}" type="text" />
                                @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- Task start date -->
                        <div class="col-6">
                            <div class="form-group mg-b-0">
                                <label class="form-label">Start Date: <span class="tx-danger">*</span></label>
                                <input class="form-control" name="date_debut" required=""
                                    value="{{ $task->date_debut }}" type="date" />
                                @error('date_debut')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- Task end date -->
                        <div class="col-6">
                            <div class="form-group mg-b-0">
                                <label class="form-label">End Date: <span class="tx-danger">*</span></label>
                                <input class="form-control" name="date_fin" required="" value="{{ $task->date_fin }}"
                                    type="date" />
                                @error('date_fin')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- Task status -->
                        {{-- <div class="col-6">
                            <div class="form-group mg-b-0">
                                <label class="form-label">Status: <span class="tx-danger">*</span></label>
                                <select name="status" class="form-control">
                                    <option value="0" {{ $task->status == 0 ? 'selected' : '' }}>Pending</option>
                                    <option value="1" {{ $task->status == 1 ? 'selected' : '' }}>Completed</option>
                                    <option value="2" {{ $task->status == 2 ? 'selected' : '' }}>In Progress</option>
                                </select>
                                @error('status')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div> --}}
                        <!-- Task link -->
                        <div class="col-12">
                            <div class="form-group mg-b-0">
                                <label class="form-label">Link: <span class="tx-danger">*</span></label>
                                <input class="form-control" name="link" placeholder="Enter link"
                                    value="{{ $task->link }}" type="text" />
                                @error('link')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group mg-b-0">
                                <label class="form-label">Details: </label>
                                <textarea class="form-control" id="content" placeholder="Enter the Description" rows="5" name="details">{{ old('details' , $task->details) }}</textarea>
                                @error('link')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- Submit button -->
                        <div class="col-12">
                            <button class="btn btn-main-primary pd-x-20 mg-t-10" type="submit">
                                Update Task
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')

    <script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor.create(document.querySelector('#content'))
            .catch(error => {
                console.error(error);
            });
    </script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
@endsection
