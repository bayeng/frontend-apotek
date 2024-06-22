@extends('layouts.index')

@section('content')

<div class="">
    <h1>Selamat Datang</h1>
    <p class="text-secondary">Dashboard</p>
    <div class="d-flex col gap-5 justify-content-center align-items-center"
        style="height: calc(100vh - 300px); margin-top: 56px;">
        <div class="card shadow-sm px-3">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-3 align-items-center">
                    <img src="{{ asset('assets/icons/obat.svg' )}}" class="img-fluid w-25" alt="logo obat">
                    <h5 class="card-title">{{ $users }}</h5>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="/users" class="btn btn-primary justify-content-end"><i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
        </div>
        <div class="card shadow-sm px-3">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-3 align-items-center">
                    <img src="{{ asset('assets/icons/obat.svg' )}}" class="img-fluid w-25" alt="logo obat">
                    <h5 class="card-title">{{$obats}}</h5>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="/obats" class="btn btn-primary justify-content-end"><i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
        </div>
        <div class="card shadow-sm px-3">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-3 align-items-center">
                    <img src="{{ asset('assets/icons/supplier.jpg' )}}" class="img-fluid w-25" alt="logo obat">
                    <h5 class="card-title">{{$supliers}}</h5>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="/supliers" class="btn btn-primary justify-content-end"><i
                            class="bi bi-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
