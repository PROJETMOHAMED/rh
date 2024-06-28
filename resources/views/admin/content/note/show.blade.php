@extends('admin.layouts.master')

@section('title', 'Update Task')

@section('content')
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="main-content-label mg-b-5">
                    voir Note
                </div>
                <div class="row row-sm">
                    <div class="col-6">
                        <div class="form-group mg-b-0">
                            <label class="form-label">Date: <span class="tx-danger">*</span></label>
                            <input class="form-control" name="date" required="" value="{{ $note->date }}"
                                type="date" disabled />

                        </div>
                    </div>
                    <!-- Task link -->
                    <div class="col-12">
                        <div class="form-group mg-b-0">
                            <label class="form-label">description : <span class="tx-danger">*</span></label>
                            {!! html_entity_decode($note->description ) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
