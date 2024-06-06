@extends('layouts.index')


@section('title', 'Pasien')

@section('sub-title','Data Pasien')

@section('content')


<a href="{{ route('pasien.create') }}" class="btn btn-primary mb-4">Add Pasien</a>
@if (Session::has('success'))
    <div class="alert alert-success" role="alert">
        {{ Session::get('success') }}
    </div>
@endif
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        DataTable Pasien
    </div>
    <div class="card-body">
        <table id="datatablesSimple">
            <thead>
                <tr>
                    <th>#</th>
                    <th>No KTP</th>
                    <th>Fullname</th>
                    <th>Gender</th>
                    <th>Dob</th>
                    <th>No Telp/Hp</th>
                    <th>Alamat</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>#</th>
                    <th>No KTP</th>
                    <th>Fullname</th>
                    <th>Gender</th>
                    <th>Dob</th>
                    <th>No Telp/Hp</th>
                    <th>Alamat</th>
                    <th>Action</th>
                </tr>
            </tfoot>
            <tbody>
                @foreach ($data as $v)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $v->no_ktp }}</td>
                        <td>{{ $v->name }}</td>
                        <td>{{ $v->gender }}</td>
                        <td>{{ $v->dob }}</td>
                        <td>{{ $v->phone }}</td>
                        <td>{{ $v->address }}</td>
                        <td>
                            <a href="{{route('pasien.edit', $v->id)}}" class="btn btn-warning">Update</a>
                            <form method="POST" action="{{route('pasien.destroy',$v->id)}}" type="submit" class="btn btn-danger p-0" onsubmit="return confirm('are you sure delete this data ?')">
                                @csrf
                                @method('DELETE')
                                <button href="" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@endsection