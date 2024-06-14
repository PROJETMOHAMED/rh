@extends('admin.layouts.master')

@section('title', 'Edit Departement')

@section('content')
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="main-content-label mg-b-5">
                    Edit Departement
                </div>
                <form action="{{ route('admin.departement.update', $type) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row row-sm">
                        <div class="col-6">
                            <div class="form-group mg-b-0">
                                <label class="form-label">name: <span class="tx-danger">*</span></label>
                                <input class="form-control" name="name" value="{{ $type->name }}"
                                    placeholder="Enter contrat type name" required="" type="text" />
                                @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        @if ($type->parent_id !== null)
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="form-label">Select Parent <span class="tx-success">(Optionel)</span></label>
                                    <select name="parent_id" class="form-control ">
                                        <option value="">Optionel</option>
                                        @forelse ($types as $item)
                                            <option value="{{ $item->id }}" @selected($item->id == $type->parent_id) >{{ $item->name }}</option>
                                        @empty
                                            
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                        @endif
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
