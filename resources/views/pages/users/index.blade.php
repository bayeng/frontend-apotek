@extends('layouts.index')

@section('content')
    <div class="">
        <h1>User</h1>
        <p class="text-secondary d-flex ">
            Dashboard / <span class="ms-1 text-dark"> User</span>
        </p>
        <div class="border p-3 me-3 shadow-sm rounded bg-white">
            {{--            <a href="{{route('add-suplier')}}" class="btn btn-primary justify-content-end mb-3">+ Tambah Suplier</a>--}}
            <button type="button" class="btn btn-primary justify-content-end mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                + Tambah User
            </button>

            <table class="table table-bordered" id="table-user">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>No. Telepon</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Dibuat pada</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$item['nama']}}</td>
                        <td>{{$item['alamat']}}</td>
                        <td>{{$item['notlp']}}</td>
                        <td>{{$item['email']}}</td>
                        <td>{{$item['role']}}</td>
                        <td>{{ \Carbon\Carbon::parse($item['created_at'])->format('Y-m-d') }}</td>
                        <td class="text-center">
                            <form action="{{ route('detail-user',  $item['id']) }}" method="POST" style="display:inline;">
                                <a href="{{route('detail-user', $item['id'])}}">Detail</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"><i class="bi-trash"></i></button>
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
                                    <div class="row">
                                        <div class="col">
                                            <label for="" class="mb-1">Nama Suplier</label>
                                            <input required name="nama" type="text" class="form-control" placeholder="Nama Suplier" aria-label="First name">
                                        </div>
                                        <div class="col">
                                            <label for="alamat" class="mb-1">Alamat</label>
                                            <input required name="alamat" type="text" class="form-control" placeholder="Alamat" aria-label="Last name">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label for="" class="mb-1">Kota</label>
                                            <input required name="kota" type="text" class="form-control" placeholder="Kota" aria-label="First name">
                                        </div>
                                        <div class="col">
                                            <label for="" class="mb-1">No tlp.</label>
                                            <input required name="notlp" type="text" class="form-control" placeholder="No tlp." aria-label="Last name">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label for="" class="mb-1">Nama Bank</label>
                                            <input required name="nama_bank" type="text" class="form-control" placeholder="Nama Bank" aria-label="First name">
                                        </div>
                                        <div class="col">
                                            <label for="" class="mb-1">No. Rekening</label>
                                            <input required name="no_rekening" type="text" class="form-control" placeholder="No. Rekening" aria-label="Last name">
                                        </div>
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