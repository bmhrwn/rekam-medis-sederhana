@extends('layouts.index')


@section('title', 'Rekam Medis')

@section('sub-title', 'Data Rekam Medis')

@section('content')


    @if (auth()->user()->roles != 'pasien')
        <a href="{{ route('rekamMed.create') }}" class="btn btn-primary mb-4">Add Rekam Medis</a>
    @endif
    @if (Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif
    @if (Session::has('failed'))
        <div class="alert alert-danger" role="alert">
            {{ Session::get('failed') }}
        </div>
    @endif
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            DataTable Rekam Medis
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>No Rekam Medis</th>
                        <th>Tgl Check-Up</th>
                        <th>No Ktp Pasien</th>
                        <th>Nama Pasien</th>
                        <th>Dokter Pemeriksa</th>
                        <th>Diagnosa</th>
                        <th>Biaya</th>
                        <th>Status</th>
                        @if (auth()->user()->roles != 'pasien')
                            <th>Action</th>
                        @endif
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>No Rekam Medis</th>
                        <th>Tgl Check-Up</th>
                        <th>No Ktp Pasien</th>
                        <th>Nama Pasien</th>
                        <th>Dokter Pemeriksa</th>
                        <th>Diagnosa</th>
                        <th>Biaya</th>
                        <th>Status</th>
                        @if (auth()->user()->roles != 'pasien')
                            <th>Action</th>
                        @endif
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($data as $v)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $v->no_rekam_medis }}</td>
                            <td>{{ $v->regist_date }}</td>
                            <td>{{ $v->pasien_no_ktp }}</td>
                            <td>{{ $v->pasien_name }}</td>
                            <td>{{ $v->dokter_name }}</td>
                            <td>{{ $v->diagnosa }}</td>
                            <td>{{ $v->harga }}</td>
                            <td>{{ $v->status }}</td>
                            @if (auth()->user()->roles != 'pasien')
                                <td>
                                    <!-- Example single danger button -->
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-success dropdown-toggle"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            Action
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li> <a class="dropdown-item"
                                                    href="{{ route('rekaMed.edit', $v->id) }}">Update</a>
                                            </li>
                                            <li>
                                                <form method="POST" action="{{ route('rekamMed.destroy', $v->id) }}"
                                                    type="submit"
                                                    onsubmit="return confirm('are you sure delete this data ?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="dropdown-item">Delete</button>
                                                </form>
                                            </li>
                                            <li>
                                                <form action="{{ route('rekamMed.finish', $v->id) }}" method="POST"
                                                    type="submit"
                                                    onsubmit="return confirm('Are you sure finish this data ?')">
                                                    @csrf
                                                    @method('PUT')
                                                    <button class="dropdown-item" type="submit">Finish</button>
                                                </form>
                                            </li>

                                        </ul>
                                    </div>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
