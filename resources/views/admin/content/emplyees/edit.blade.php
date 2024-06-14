@extends('admin.layouts.master')

@section('title', 'Create Departement')

@section('content')
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="main-content-label mg-b-5">
                    Create A New Employee
                </div><br>
                <form action="{{ route('admin.employees.update', $employee) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row row-sm">
                        <div class="col-4">
                            <div class="form-group mg-b-0">
                                <label class="form-label">First Name: <span class="tx-danger">*</span></label>
                                <input class="form-control" name="firstname" value="{{ $employee->firstname }}"
                                    placeholder="Enter employee first name" type="text" />
                                @error('firstname')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group mg-b-0">
                                <label class="form-label">Last Name: <span class="tx-danger">*</span></label>
                                <input class="form-control" name="last_name" value="{{ $employee->last_name }}"
                                    placeholder="Enter employee last name" required="" type="text" />
                                @error('last_name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group mg-b-0">
                                <label class="form-label">Sexe: <span class="tx-danger">*</span></label><br>
                                <div class="radio-group">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="sexe" id="male"
                                            value="homme" {{ $employee->sexe == 'homme' ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="male">Male</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="sexe" id="female"
                                            value="femme" {{ $employee->sexe == 'femme' ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="female">Female</label>
                                    </div>
                                </div>
                                @error('sexe')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        <div class="col-6">
                            <div class="form-group mg-b-0">
                                <label class="form-label">Email: </label>
                                <input class="form-control" name="email" placeholder="Enter employee email" type="email"
                                    value="{{ $employee->email }}" />
                                @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group mg-b-0">
                                <label class="form-label">Phone: <span class="tx-danger">*</span></label>
                                <input class="form-control" name="phone" placeholder="Enter employee phone number"
                                    value="{{ $employee->phone }}" required="" type="text" />
                                @error('phone')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group mg-b-0">
                                <label class="form-label">Date Debut: <span class="tx-danger">*</span></label>
                                <input class="form-control" name="date_debut" value="{{ $employee->date_debut }}" id="date_debut"
                                    placeholder="Enter Date Debut" required="" type="date" />
                                @error('debut')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group mg-b-0">
                                <label class="form-label">Date Fin: </label>
                                <input class="form-control" name="date_fin" value="{{ $employee->date_fin }}" id="date_fin"
                                    type="date" />
                                @error('date_fin')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <span id="date_difference" class="tx-info"></span>
                            </div>
                        </div>
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const dateDebutInput = document.getElementById('date_debut');
                                const dateFinInput = document.getElementById('date_fin');
                                const dateDifferenceSpan = document.getElementById('date_difference');

                                dateDebutInput.addEventListener('change', calculateDateDifference);
                                dateFinInput.addEventListener('change', calculateDateDifference);

                                function calculateDateDifference() {
                                    const dateDebut = new Date(dateDebutInput.value);
                                    const dateFin = new Date(dateFinInput.value);

                                    if (dateDebutInput.value && dateFinInput.value && dateFin > dateDebut) {
                                        const difference = getDateDifference(dateDebut, dateFin);
                                        dateDifferenceSpan.textContent = difference;
                                    } else {
                                        dateDifferenceSpan.textContent = '';
                                    }
                                }

                                function getDateDifference(date1, date2) {
                                    const diffTime = Math.abs(date2 - date1);
                                    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                                    const years = Math.floor(diffDays / 365);
                                    const months = Math.floor((diffDays % 365) / 30);
                                    const days = diffDays % 30;

                                    let difference = '';
                                    if (years > 0) {
                                        difference += years + (years === 1 ? ' year ' : ' years ');
                                    }
                                    if (months > 0) {
                                        difference += months + (months === 1 ? ' month ' : ' months ');
                                    }
                                    if (days > 0) {
                                        difference += days + (days === 1 ? ' day' : ' days');
                                    }
                                    return difference.trim();
                                }
                            });
                        </script>
                        <div class="col-6">
                            <div class="form-group mg-b-0">
                                <label class="form-label">Piece D'entité (CNIE - pASSPORT - carte siege .....) : <span
                                        class="tx-danger">*</span></label>
                                <input class="form-control" name="piece_identite" type="text"
                                    value="{{ $employee->piece_identite }}" />
                                @error('date_fin')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group mg-b-0">
                                <label class="form-label">Adresse : </label>
                                <textarea name="adresse" class="form-control" id="" cols="30" rows="10" placeholder="Adresse">{{ $employee->adresse }}</textarea>
                                @error('date_fin')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group mg-b-0">
                                <label class="form-label">Departement: <span class="tx-danger">*</span></label>
                                <select name="departement_id" class="form-control SlectBox SumoUnder">
                                    @foreach ($departements as $item)
                                        <option value="{{ $item->id }}" @selected($item->id === $employee->departement_id)>
                                            {{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('departement_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group mg-b-0">
                                <label class="form-label">Type de contract: <span class="tx-danger">*</span></label>
                                <select id="all_conract" class="form-control SlectBox SumoUnder" onchange="GetData()">
                                    <option value=""></option>
                                    @foreach ($types as $item)
                                        <option value="{{ $item->id }}" @selected($item->id === $employee->type_id)>
                                            {{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('type_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group mg-b-0" id="contract_list" style="display: none">
                                <label class="form-label">Type Contract: <span class="tx-danger">*</span></label>
                                <select name="type_id" id="avalaible_contract" class="form-control SlectBox SumoUnder">
                                </select>
                                @error('type_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-main-primary pd-x-20 mg-t-10" type="submit">Validate Form</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        function GetData() {
            parentId = document.getElementById("all_conract").value;
            console.log(parentId);
            $.ajax({
                url: "{{ route('api.GetChildren') }}",
                data: {
                    parentId: parentId
                },
                type: "GET",
                success: function(response) {
                    if (response.status === 'success') {
                        // Clear existing options in the select element
                        $('#avalaible_contract').empty();
                        // $('#errorSpan').hide();
                        $('#contract_list').show();

                        response.data.forEach(function(item) {
                            $('#avalaible_contract').append(
                                `<option value="${item.id}"> ${item.name}</option>`);
                        });
                    } else {
                        console.log(response);
                        // $('#errorSpan').text(response.message).show();
                        $('#contract_list').hide();
                    }
                },
                error: function(xhr, status, error) {
                    alert("An error occurred: " + error);
                }
            });
        }
    </script>
@endsection
