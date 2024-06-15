@extends('admin.layouts.master')

@section('title', 'Edit User')


@section('content')
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="main-content-label mg-b-5">
                    Edit User
                </div>
                <form action="{{ route('admin.users.update', $user) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row row-sm">
                        <div class="col-6">
                            <div class="form-group mg-b-0">
                                <label class="form-label">name: <span class="tx-danger">*</span></label>
                                <input class="form-control" name="name" placeholder="Enter user name" required
                                    value="{{ $user->name }}" type="text" />
                                @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group mg-b-0">
                                <label class="form-label">email: <span class="tx-danger">*</span></label>
                                <input class="form-control" name="email" placeholder="Enter user email" required
                                    value="{{ $user->email }}" type="email" />
                                @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group mg-b-0">
                                <label class="form-label">Password: <span class="tx-danger">*</span></label>
                                <div class="input-group">
                                    <input class="form-control" name="password" placeholder="Enter user password" required
                                        value="" type="password" id="passwordField" />
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                            <i class="fas fa-eye" id="toggleIcon"></i>
                                        </button>
                                    </div>
                                </div>
                                @error('password')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <script>
                            const togglePassword = document.querySelector('#togglePassword');
                            const passwordField = document.querySelector('#passwordField');
                            const toggleIcon = document.querySelector('#toggleIcon');

                            togglePassword.addEventListener('click', function(e) {
                                const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
                                passwordField.setAttribute('type', type);
                                toggleIcon.classList.toggle('fa-eye-slash');
                            });
                        </script>

                        <div class="col-6">
                            <div class="form-group mg-b-0">
                                <label class="form-label">Role: <span class="tx-danger">*</span></label>
                                <select name="role" class="form-control SlectBox SumoUnder">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->name }}"
                                            @if ($user->hasRole($role->name)) selected @endif>
                                            {{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('password')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <label class="form-label">permissions : <span class="tx-danger">*</span></label>
                            <div class="form-check">
                                @foreach ($permissions as $item)
                                    <input type="checkbox" name="permission[]" class="form-check-input"
                                        value="{{ $item->name }}" id="permission-{{ $item->id }}"
                                        @checked($user->hasPermissionTo($item->name))>
                                    <label for="permission-{{ $item->id }}"
                                        class="form-check-label">{{ $item->name }}</label><br>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-6">
                            <label class="form-label">Departments: <span class="tx-danger">*</span></label>
                            <div class="form-check">
                                @foreach ($departements as $departement)
                                    <input type="checkbox" name="departements[]" class="form-check-input"
                                        value="{{ $departement->id }}" id="departement-{{ $departement->id }}"
                                        {{ $user->departements->contains('id', $departement->id) ? 'checked' : '' }}>
                                    <label for="departement-{{ $departement->id }}"
                                        class="form-check-label">{{ $departement->name }}</label><br>
                                @endforeach
                            </div>
                            @error('departements')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
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
