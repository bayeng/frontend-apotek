@extends('layouts.index')

@section('content')

    <div class="border bg-white shadow-sm rounded p-2 px-5 row justify-content-between align-items-center">
        <div class="col-auto">
            <h1>Detail Suplier</h1>
        </div>
        <div class="col-auto">
            <button type="button" class="btn btn-warning text-white" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Edit
            </button>
            <a href="/supliers" class="btn-secondary btn">Kembali</a>
        </div>
    </div>
    <div class="border bg-white shadow-sm rounded p-2 px-5 d-flex justify-content-between align-items-center mt-5">
        <table class="table">
            <tbody>
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td>{{$suplier['nama']}}</td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td>{{$suplier['alamat']}}</td>
                </tr>
                <tr>
                    <td>Kota</td>
                    <td>:</td>
                    <td>{{$suplier['kota']}}</td>
                </tr>
                <tr>
                    <td>No. Telepon</td>
                    <td>:</td>
                    <td>{{$suplier['notlp']}}</td>
                </tr>
                <tr>
                    <td>Nama Bank</td>
                    <td>:</td>
                    <td>{{$suplier['nama_bank']}}</td>
                </tr>
                <tr>
                    <td>No Rekening</td>
                    <td>:</td>
                    <td>{{$suplier['no_rekening']}}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Suplier</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="" method="POST" action="{{route('edit-suplier', $suplier['id'])}}">
                        @csrf
                        @method('PATCH')
                        <div class="mb-3">
                            <div class="row">
                                <div class="col">
                                    <label for="" class="mb-1">Nama Suplier</label>
                                    <input required name="nama" type="text" class="form-control" placeholder="Nama Suplier" aria-label="First name" value="{{$suplier['nama']}}">
                                </div>
                                <div class="col">
                                    <label for="alamat" class="mb-1">Alamat</label>
                                    <input required name="alamat" type="text" class="form-control" placeholder="Alamat" aria-label="Last name" value="{{$suplier['alamat']}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="" class="mb-1">Kota</label>
                                    <input required name="kota" type="text" class="form-control" placeholder="Kota" aria-label="First name" value="{{$suplier['kota']}}">
                                </div>
                                <div class="col">
                                    <label for="" class="mb-1">No tlp.</label>
                                    <input required name="notlp" type="text" class="form-control" placeholder="No tlp." aria-label="Last name" value="{{$suplier['notlp']}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="" class="mb-1">Nama Bank</label>
                                    <input required name="nama_bank" type="text" class="form-control" placeholder="Nama Bank" aria-label="First name" value="{{$suplier['nama_bank']}}">
                                </div>
                                <div class="col">
                                    <label for="" class="mb-1">No. Rekening</label>
                                    <input required name="no_rekening" type="text" class="form-control" placeholder="No. Rekening" aria-label="Last name" value="{{$suplier['no_rekening']}}">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
