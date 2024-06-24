@extends('layouts.index')

@section('content')

<div class="">
    <h3>Dashboard</h3>
    <p class="text-secondary">Dashboard</p>
    <div class="d-flex col row gap-3 justify-content-center mt-5">
        <div style="width: 32%" class="card mb-3 border-success">
            <div class="row g-0">
                <div class="col-md-4 d-flex justify-content-center align-items-center">
                    <i class="bi bi-box-arrow-up-left fw-semibold text-success" style="font-size: 5rem"></i>
                </div>
                <div class="col-md-8 text-end h-100">
                    <div class="card-body d-flex flex-column h-100 justify-content-between">
                        <p class="card-title fw-medium" style="font-size: 0.8rem">Transaksi Keluar</p>
                        <h5 class="card-text fs-2 fw-bold text-success">{{ $transaksikeluar }}</h5>
                    </div>
                </div>
            </div>
        </div>
        <div style="width: 32%" class="card mb-3 border-warning">
            <div class="row g-0">
                <div class="col-md-4 d-flex justify-content-center align-items-center">
                    <i class="bi bi-box-arrow-in-up-left fw-semibold text-warning" style="font-size: 5rem"></i>
                </div>
                <div class="col-md-8 text-end h-100">
                    <div class="card-body d-flex flex-column h-100 justify-content-between">
                        <p class="card-title fw-medium" style="font-size: 0.8rem">Transaksi Masuk</p>
                        <h5 class="card-text fs-2 fw-bold text-warning">{{ $transaksimasuk }}</h5>
                    </div>
                </div>
            </div>
        </div>
        <div style="width: 32%" class="card mb-3 border-info">
            <div class="row g-0">
                <div class="col-md-4 d-flex justify-content-center align-items-center">
                    <i class="bi bi-wallet2 fw-semibold text-info" style="font-size: 5rem"></i>
                </div>
                <div class="col-md-8 text-end h-100">
                    <div class="card-body d-flex flex-column h-100 justify-content-between">
                        <p class="card-title fw-medium" style="font-size: 0.8rem">Omzet</p>
                        <h5 class="card-text fs-2 fw-bold text-info">Rp. {{ number_format($omzet, 0, ',', '.') }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-5">
        <p class="fw-medium">Stok Obat Terendah</p>

        <table class="table table-bordered table-hover" id="table">
            <thead class="table-primary">
                <tr>
                    <th style="width: 10%">No</th>
                    <th style="width: 60%">Nama Obat</th>
                    <th style="width: 30%">Stok</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($dangerstok as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item['nama' ] }}</td>
                    <td>{{ $item['stok'] }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center">Tidak ada data</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
