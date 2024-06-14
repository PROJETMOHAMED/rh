@extends('admin.layouts.master')

@section('title', 'Users Home')

@section('content')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Users</h4><span class="text-muted mt-1 tx-13 ml-2 mb-0">/
                    List</span>
            </div>
        </div>
        <div class="d-flex my-xl-auto right-content">
            @can('create user')
                <div class="pr-1 mb-3 mb-xl-0">
                    <a href="{{ route('admin.users.create') }}" title="Create New User" type="button" class="btn btn-info btn-sm">
                        <i class="fa-solid fa-plus"></i>
                    </a>
                </div>
            @endcan
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
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>permissions</th>
                                    <th>Departements</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $item)
                                    <tr>
                                        <th scope="row">{{ $item->id }}</th>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>
                                            @foreach ($item->roles as $role)
                                                {{ $role->name }}
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($item->permissions as $per)
                                                <a @can('delete user')
                                                    
                                                href="{{ route('admin.DeletePermissionFromUser', ['user' => $item, 'permission' => $per->name]) }}"

                                                    onclick="return confirm('Are you sure you would like to delete this permission from the user?');"
                                                @endcan
                                                    class="tag tag-rounded bg-success text-white">
                                                    {{ $per->name }}
                                                </a>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($item->departements as $departement)
                                                <a href="{{ route('admin.removeDepartmentFromUser', ['user' => $item, 'department' => $departement]) }}"
                                                    onclick="return confirm('Are you sure you would like to delete this departement from the user?');"
                                                    class="tag tag-rounded bg-success text-white">
                                                    {{ $departement->name }}
                                                </a>
                                            @endforeach
                                        </td>

                                        <td class="d-flex">
                                            @can('edit user')
                                                <a href="{{ route('admin.users.edit', $item) }}" class="btn btn-warning btn-sm"
                                                    style="margin-right: 5px"><i class="fa-solid fa-pen "></i></a>
                                            @endcan

                                            @can('delete user')
                                                <form action="{{ route('admin.users.destroy', $item) }}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button
                                                        onclick="return confirm('Are you sure you want to delete this item?');"
                                                        class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>
                                                </form>
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
