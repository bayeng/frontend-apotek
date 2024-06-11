@extends('layouts.index')

@section('content')
<div class="">
    <h1>Obat</h1>
    <p class="text-secondary d-flex ">
        Dashboard / <span class="ms-1 text-dark"> Obat</span>
    </p>
    <div class="border p-3 me-3 shadow-sm rounded bg-white">
        {{-- <a href="{{route('add-suplier')}}" class="btn btn-primary justify-content-end mb-3">+ Tambah
            Suplier</a>--}}
        <button type="button" class="btn btn-primary justify-content-end mb-3" data-bs-toggle="modal"
            data-bs-target="#exampleModal">
            + Tambah Obat
        </button>

        <table class="table table-bordered" id="table-user">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Jenis</th>
                    <th>Harga Jual</th>
                    <th>Harga Beli</th>
                    <th>Stok</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($obats as $item)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$item['nama']}}</td>
                    <td>{{$item['jenis_obat']}}</td>
                    <td>{{$item['harga_jual']}}</td>
                    <td>{{$item['harga_beli']}}</td>
                    <td>{{$item['stok']}}</td>
                    <td class="text-center ">
                        <form action="{{ route('detail-user',  $item['id']) }}" method="POST" style="display:inline;">
                            <div class="d-flex justify-content-center align-items-center gap-2">
                                <a href="{{route('detail-user', $item['id'])}}" class="btn-warning btn"><i
                                        class="bi-pencil"></i></a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"><i class="bi-trash"></i></button>
                            </div>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Suplier</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="" method="post" action="{{route('store-suplier')}}">
                            @csrf
                            <div class="mb-3">
                                <div class="mb-3">
                                    <label for="nama" class="mb-1">Nama Obat</label>
                                    <input required name="nama" type="text" class="form-control" placeholder="Nama Obat"
                                        aria-label="Tanggal Datange">
                                </div>
                                <div class="mb-3">
                                    <label for="jenis_obat" class="mb-1">Jenis Obat</label>
                                    <input required name="jenis_obat" type="text" class="form-control"
                                        aria-label="Jenis Kelamin">
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="harga_beli" class="mb-1">Harga Jual</label>
                                        <input required name="harga_jual" type="number" class="form-control"
                                            aria-label="First name">
                                    </div>
                                    <div class="col">
                                        <label for="harga_beli" class="mb-1">Harga Beli</label>
                                        <input required name="harga_beli" type="number" class="form-control"
                                            aria-label="Last name">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="stok" class="mb-1">Stok</label>
                                    <input required name="stok" type="number" class="form-control"
                                        aria-label="First name">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Tambah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection

@section('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="module">
    $(document).ready(function() {
            console.log()
            $('#table-user').DataTable();
        });

</script>
@endsection
