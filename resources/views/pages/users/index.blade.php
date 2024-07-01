@extends('layouts.index')

@section('content')

<div class="">
    <h1>User</h1>
    <p class="text-secondary d-flex ">
        Dashboard / <span class="ms-1 text-dark"> User</span>
    </p>
    <div class="border p-3 me-3 shadow-sm rounded bg-white">
        {{-- <a href="{{route('add-suplier')}}" class="btn btn-primary justify-content-end mb-3">+ Tambah
            Suplier</a>--}}
        <button type="button" class="btn btn-primary justify-content-end mb-3" data-bs-toggle="modal"
            data-bs-target="#exampleModal">
            + Tambah User
        </button>

        <table class="table table-bordered" id="table-user">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $item)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$item['nama']}}</td>
                    <td>{{$item['role']}}</td>
                    <td class="text-center ">
                        <form action="{{ route('delete-user',  $item['id']) }}" method="POST" style="display:inline;">
                            <div class="d-flex justify-content-center align-items-center gap-2">
                                <a href="{{route('detail-user', $item['id'])}}" class="btn-warning btn text-white">Detail</a>
                                @csrf
                                @method('DELETE')
                                <button onclick="confirmDelete(event)" type="button" class="btn btn-danger">Hapus</button>
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
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah User</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="" method="post" action="{{route('store-user')}}">
                            @csrf
                            <div class="mb-3">
                                <div class="row mb-2">
                                    <div class="col">
                                        <label for="nama" class="mb-1">Nama</label>
                                        <input required name="nama" type="text" class="form-control"
                                            placeholder="" aria-label="Tanggal Datang">
                                    </div>
                                    <div class="col">
                                        <label for="jenis_kelamin" class="mb-1">Jenis Kelamin</label>
                                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                                            <option value="1">Laki-laki</option>
                                            <option value="0">Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col">
                                        <label for="" class="mb-1">Tempat Lahir</label>
                                        <input required name="tempat_lahir" type="text" class="form-control"
                                            aria-label="First name">
                                    </div>
                                    <div class="col">
                                        <label for="" class="mb-1">Tanggal Lahir</label>
                                        <input required name="tgl_lahir" type="date" class="form-control"
                                            aria-label="Last name">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col">
                                        <label for="" class="mb-1">Golongan Darah</label>
                                        <input required name="gol_darah" type="text" class="form-control"
                                            aria-label="First name">
                                    </div>
                                    <div class="col">
                                        <label for="" class="mb-1">Agama</label>
                                        <input required name="agama" type="text" class="form-control"
                                            aria-label="First name">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col">
                                        <label for="" class="mb-1">Alamat</label>
                                        <input required name="alamat" type="text" class="form-control"
                                            aria-label="First name">
                                    </div>
                                    <div class="col">
                                        <label for="" class="mb-1">No. Telepon</label>
                                        <input required name="notlp" type="text" class="form-control"
                                            aria-label="First name">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col">
                                        <label for="" class="mb-1">NIP</label>
                                        <input required name="nip" type="text" class="form-control"
                                            aria-label="First name">
                                    </div>
                                    <div class="col">
                                        <label for="" class="mb-1">Username</label>
                                        <input required name="username" type="text" class="form-control"
                                            aria-label="First name">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col">
                                        <label for="" class="mb-1">Password</label>
                                        <input required name="password" type="password" class="form-control"
                                               aria-label="First name">
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{asset('js/alert.js')}}"></script>
    @if(session('success'))
        <script>
            showNotification('success', '{{session('success')}}')
        </script>
    @elseif(session('error'))
        <script>
            showNotification('error', '{{session('error')}}')
        </script>
    @endif
<script type="module">
    $(document).ready(function() {
            console.log()
            $('#table-user').DataTable();
        });

</script>

@endsection
