@extends('layouts.index')


@section('title', 'User')

@section('sub-title','Create User')

@section('content')

<div class="card shadow-lg border-0 rounded-lg mt-5">
    <div class="card-header">
        <h3 class="text-center font-weight-light my-4">Create User</h3>
    </div>
    @if (Session::has('failed'))
    <div class="alert alert-danger" role="alert">
        {{ Session::get('failed') }}
    </div>
@endif

    <div class="card-body">
        <form method="POST" action="{{ route('user.store') }}">
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
                        <input class="form-control @error('email')is-invalid  @enderror" id="email"
                            name="email" type="email" placeholder="Enter Email" />
                        <label for="email">Email</label>
                        @error('email')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating mb-3 mb-md-0">
                        <select name="roles" class="form-select @error('roles')is-invalid  @enderror" id="roles">
                            <option value="">-- Select Roles -- </option>
                            <option value="staff">Staff</option>
                            <option value="pasien">Pasien</option>
                        </select>
                        <label for="roles">Roles</label>
                        @error('roles')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="form-floating mb-3 mb-md-0">
                        <input class="form-control  @error('password')is-invalid  @enderror" id="password" name="password"
                            type="password" placeholder="Enter your password" />
                        <label for="password">Password</label>
                        @error('password')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <input class="form-control @error('cPassword')is-invalid  @enderror" id="cPassword" name="cPassword"
                            type="password" placeholder="Enter your cPassword" />
                        <label for="cPassword">Confirm Password</label>
                        @error('cPassword')
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