@extends('layouts.index')


@section('title', 'Pasien')

@section('sub-title', 'Create Pasien')

@section('content')


    <div class="card shadow-lg border-0 rounded-lg mt-5">
        <div class="card-header">
            <h3 class="text-center font-weight-light my-4">Create Pasien</h3>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('pasien.store') }}">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-floating mb-3 mb-md-0">
                            <input class="form-control @error('no_ktp')is-invalid  @enderror" id="no_ktp" name="no_ktp"
                                type="text" placeholder="Enter your Nomer Ktp" />
                            <label for="no_ktp">No KTP</label>
                            @error('no_ktp')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input class="form-control @error('name')is-invalid  @enderror" id="Fullname" name="name"
                                type="text" placeholder="Enter your Full name" />
                            <label for="Fullname">Full name</label>
                            @error('name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-floating mb-3 mb-md-0">
                            <select name="gender" class="form-select @error('gender')is-invalid  @enderror" id="gender">
                                <option value="">-- Select Gender -- </option>
                                <option value="MALE">Male</option>
                                <option value="FEMALE">Female</option>
                            </select>
                            <label for="gender">Gender</label>
                            @error('gender')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3 mb-md-0">
                            <input class="form-control @error('dob')is-invalid  @enderror" id="dob"
                                name="dob" type="date" placeholder="Enter Sepsialis" />
                            <label for="dob">Date Of Bird</label>
                            @error('dob')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-floating mb-3 mb-md-0">
                            <input class="form-control  @error('phone')is-invalid  @enderror" id="phone" name="phone"
                                type="text" placeholder="Enter your Phone" />
                            <label for="phone">Phone</label>
                            @error('phone')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input class="form-control @error('address')is-invalid  @enderror" id="address" name="address"
                                type="text" placeholder="Enter your Address" />
                            <label for="address">Address</label>
                            @error('address')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="mt-4 mb-0">
                    <div class="d-grid"><button class="btn btn-primary btn-block" type="submit">Create</button></div>
                </div>
            </form>
        </div>

    </div>
@endsection
