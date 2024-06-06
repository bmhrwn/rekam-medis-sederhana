@extends('layouts.index')

@section('title', 'Rekam Medis')

@section('sub-title', 'Edit Rekam Medis')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card mb-4">
                    <div class="card-header py-3">
                        <h5 class="mb-0">Data Pasien</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('rekamMed.update',$data->id)}}">
                            @csrf
                            @method('PUT')
                            <!-- Text input -->
                            <div data-mdb-input-init class="form-outline mt-3 mb-4">
                                <select type="text" name="patient_id" id="patient_id"
                                    class="form-select @error('patient_id')is-invalid @enderror">
                                    <option value="{{$data->patient_id}}">-- Select Patient --</option>
                                    @foreach ($pasien as $v)
                                        <option value="{{ $v->id }}">{{ $v->name }} | {{ $v->no_ktp }}
                                        </option>
                                    @endforeach
                                </select>
                                <label class="form-label" for="patient_id">Pasien</label>
                                @error('patient_id')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Text input -->
                            <div data-mdb-input-init class="form-outline mb-4">
                                <input type="text" name="name" id="form6Example4" class="form-control" disabled />
                                <label class="form-label" for="form6Example4">Nama Lengkap</label>
                            </div>

                            <!-- Email input -->
                            <div data-mdb-input-init class="form-outline mb-4">
                                <input type="email" id="gender" name="gender" class="form-control" disabled />
                                <label class="form-label" for="gender">Jenis Kelamin</label>
                            </div>

                            <!-- Number input -->
                            <div data-mdb-input-init class="form-outline mb-4">
                                <input type="text" id="alamat" name="address" class="form-control" disabled />
                                <label class="form-label" for="alamat">Alamat</label>
                            </div>

                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="card mb-4">
                    <div class="card-header py-3">
                        <h5 class="mb-0">Data Dokter</h5>
                    </div>
                    <div class="card-body">
                        <!-- Text input -->
                        <div data-mdb-input-init class="form-outline mt-3 mb-4">
                            <select type="text" name="dokter_id" id="dokter_id"
                                class="form-select @error('dokter_id')is-invalid @enderror">
                                <option value="{{$data->dokter_id}}">-- Select Dokter --</option>
                                @foreach ($dokter as $v)
                                    <option value="{{ $v->id }}">{{ $v->name }} | {{ $v->no_ktp }}</option>
                                @endforeach
                            </select>
                            <label class="form-label" for="dokter_id">Dokter</label>
                            @error('dokter_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Text input -->
                        <div data-mdb-input-init class="form-outline mb-4">
                            <input type="text" id="form6Example4" class="form-control" disabled />
                            <label class="form-label" for="form6Example4">Nama Lengkap</label>
                        </div>

                        <!-- Email input -->
                        <div data-mdb-input-init class="form-outline mb-4">
                            <input type="email" id="gender" class="form-control" disabled />
                            <label class="form-label" for="gender">Jenis Kelamin</label>
                        </div>

                        <!-- text input -->
                        <div data-mdb-input-init class="form-outline mb-4">
                            <input type="text" id="alamat" class="form-control" disabled />
                            <label class="form-label" for="alamat">Spesialis</label>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card mb-4">
                    <div class="card-header py-3">
                        <h5 class="mb-0">Data Tambahan</h5>
                    </div>
                    <div class="card-body">

                        <!-- Text input -->
                        <div data-mdb-input-init class="form-outline mb-4">
                            <input type="text" value="{{$data->diagnosa}}" name="diagnosa" id="form6Example4"
                                class="form-control @error('diagnosa')is-invalid @enderror" />
                            <label class="form-label" for="form6Example4">Diagnosa</label>
                            @error('diagnosa')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Email input -->
                        <div data-mdb-input-init class="form-outline mb-4">
                            <input type="number" value="{{$data->harga}}" id="harga" name="harga"
                                class="form-control @error('harga')is-invalid @enderror" />
                            <label class="form-label" for="harga">Harga</label>
                            @error('harga')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-warning">Update</button>
                <a href="{{ route('rekamMed') }}" class="btn btn-secondary">Back</a>
                <form>
            </div>
        </div>
    </div>

@endsection
