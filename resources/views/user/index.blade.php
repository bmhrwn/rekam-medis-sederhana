@extends('layouts.index')


@section('title', 'User')

@section('sub-title','Data User')

@section('content')


<a href="{{ route('user.create') }}" class="btn btn-primary mb-4">Add User</a>
@if (Session::has('success'))
    <div class="alert alert-success text-center" role="alert">
        {{ Session::get('success') }}
    </div>
@endif
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        DataTable User
    </div>
    <div class="card-body">
        <table id="datatablesSimple">
            <thead>
                <tr>
                    <th>#</th>
                    <th>No KTP</th>
                    <th>Fullname</th>
                    <th>Email</th>
                    <th>Roles</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>#</th>
                    <th>No KTP</th>
                    <th>Fullname</th>
                    <th>Email</th>
                    <th>Roles</th>
                    <th>Action</th>
                </tr>
            </tfoot>
            <tbody>
                @foreach ($data as $v)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $v->no_ktp }}</td>
                        <td>{{ $v->name }}</td>
                        <td>{{ $v->email }}</td>
                        <td>{{ $v->roles }}</td>
                        <td>
                            <a href="{{route('user.edit', $v->id)}}" class="btn btn-warning">Update</a>
                            <form method="POST" action="{{route('user.destroy',$v->id)}}" type="submit" class="btn btn-danger p-0" onsubmit="return confirm('are you sure delete this data ?')">
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