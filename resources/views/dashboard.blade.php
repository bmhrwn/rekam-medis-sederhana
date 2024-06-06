@extends('layouts.index')


@section('title', 'Dashboard')

@section('sub-title','Dashboard')

@section('content')

<div class="row">
    @if (auth()->user()->roles != 'pasien' )
    <div class="col-xl-3 col-md-6">
        <div class="card bg-primary text-white mb-4">
            <div class="card-body">Pasien</div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <h3 class="text-white ">{{$pasien}}</h3>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-danger text-white mb-4">
            <div class="card-body">Dokter</div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <h3 class="text-white ">{{$dokter}}</h3>
            </div>
        </div>
    </div>
    @endif
    <div class="col-xl-3 col-md-6">
        <div class="card bg-warning text-white mb-4">
            <div class="card-body">Rekam Medis (Pemeriksaan)</div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <h3 class="text-white ">{{$pemeriksaan}}</h3>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-success text-white mb-4">
            <div class="card-body">Rekam Medis (Selesai)</div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <h3 class="text-white ">{{$finish}}</h3>
            </div>
        </div>
    </div>
</div>

@endsection