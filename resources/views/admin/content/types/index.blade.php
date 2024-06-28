@extends('admin.layouts.master')

@section('title', 'Departement Home')

@section('content')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Contrat Type</h4><span class="text-muted mt-1 tx-13 ml-2 mb-0">/
                    Index</span>
            </div>
        </div>
        <div class="d-flex my-xl-auto right-content">
            <div class="pr-1 mb-3 mb-xl-0">
                <a href="{{ route('admin.types.create') }}" type="button" class="btn btn-info btn-sm">
                    <i class="fa-solid fa-plus"></i>
                </a>
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
                                    <th>children</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <th scope="row">{{ $item->id }}</th>
                                        <td>{{ $item->name }}</td>
                                        <td>
                                            @forelse ($item->children as $child)
                                                <a href="{{ route('admin.types.edit', $child) }}"
                                                    class="tag tag-rounded tag-lime">{{ $child->name }}</a>
                                            @empty
                                                No Child Found
                                            @endforelse
                                        </td>
                                        <td class="d-flex">
                                            <a href="{{ route('admin.types.edit', $item) }}" class="btn btn-warning btn-sm"
                                                style="margin-right: 5px"><i class="fa-solid fa-pen"></i></a>
                                            @if ($item->children->count() == 0)
                                                <form action="{{ route('admin.types.destroy', $item) }}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button
                                                        onclick="return confirm('Are you sure you want to delete this item?');"
                                                        class="btn btn-danger btn-sm"><i
                                                            class="fa-solid fa-trash"></i></button>
                                                </form>
                                            @endif
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
