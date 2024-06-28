@extends('admin.layouts.master')

@section('title', 'show Task')

@section('content')
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="main-content-label mg-b-5">
                    show Task
                </div>
                <div class="row row-sm">
                    <!-- Employee name -->
                    <div class="col-6">
                        <div class="form-group mg-b-0">
                            <label class="form-label">Employee Name: </label>
                            <input class="form-control" name="name" placeholder="Enter task name" disabled
                                value="{{ $task->employee->full_name }}" type="text" />
                        </div>
                    </div>
                    <!-- Task name -->
                    <div class="col-6">
                        <div class="form-group mg-b-0">
                            <label class="form-label">Task:</label>
                            <input class="form-control" name="name" placeholder="Enter task name" disabled
                                value="{{ $task->name }}" type="text" />
                        </div>
                    </div>
                    <!-- Task start date -->
                    <div class="col-6">
                        <div class="form-group mg-b-0">
                            <label class="form-label">Start Date: </label>
                            <input class="form-control" name="date_debut" value="{{ $task->date_debut }}" disabled
                                type="date" />
                        </div>
                    </div>
                    <!-- Task end date -->
                    <div class="col-6">
                        <div class="form-group mg-b-0">
                            <label class="form-label">End Date: </label>
                            <input class="form-control" name="date_fin" disabled value="{{ $task->date_fin }}"
                                type="date" />
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group mg-b-0">
                            <label class="form-label">Link:</label>
                            <input class="form-control" name="link" placeholder="Enter link" value="{{ $task->link }}"
                                type="text" disabled />
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group mg-b-0">
                            <label class="form-label">details:</label>
                            {!! html_entity_decode($task->details) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
