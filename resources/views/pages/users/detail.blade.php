@extends('layouts.index')

@section('content')

    <div class="border bg-white shadow-sm rounded p-2 px-5 row justify-content-between align-items-center">
        <div class="col-auto">
            <h1>{{$user['nama']}}</h1>
        </div>
        <div class="col-auto">
            <button type="button" class="btn btn-warning text-white" data-bs-toggle="modal"
                    data-bs-target="#exampleModal">
                Edit
            </button>
            <a href="/users" class="btn-secondary btn">Kembali</a>
        </div>
    </div>
    <div class="border bg-white shadow-sm rounded p-2 px-5 d-flex justify-content-between align-items-center mt-5">
        <table class="table">
            <tbody>
            <tr>
                <td>Jenis Kelamin</td>
                <td>:</td>
                <td>{{$user['jenis_kelamin'] == 1 ? 'Laki-laki':'Perempuan'}}</td>
            </tr>
            <tr>
                <td>Tempat Lahir</td>
                <td>:</td>
                <td>{{$user['tempat_lahir']}}</td>
            </tr>
            <tr>
                <td>tgl_lahir</td>
                <td>:</td>
                <td>{{$user['tgl_lahir']}}</td>
            </tr>
            <tr>
                <td>Golongan Darah</td>
                <td>:</td>
                <td>{{$user['gol_darah']}}</td>
            </tr>
            <tr>
                <td>Agama</td>
                <td>:</td>
                <td>{{$user['agama']}}</td>
            </tr>
            <tr>
                <td>NIP</td>
                <td>:</td>
                <td>{{$user['nip']}}</td>
            </tr>
            <tr>
                <td>Username</td>
                <td>:</td>
                <td>{{$user['username']}}</td>
            </tr>
            <tr>
                <td>Role</td>
                <td>:</td>
                <td>{{$user['role']}}</td>
            </tr>
            <tr>
                <td>NIP</td>
                <td>:</td>
                <td>{{$user['nip']}}</td>
            </tr>
            <tr>
                <td>No. Telepon</td>
                <td>:</td>
                <td>{{$user['notlp']}}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td>{{$user['alamat']}}</td>
            </tr>
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="" method="post" action="{{route('edit-user', $user['id'])}}" id="form-edit">
                        @csrf
                        @method('PATCH')
                        <div class="mb-3">
                            <div class="row mb-2">
                                <div class="col">
                                    <label for="nama" class="mb-1">Nama</label>
                                    <input required name="nama" type="text" class="form-control"
                                           placeholder="" aria-label="Tanggal Datang" value="{{$user['nama']}}">
                                </div>
                                <div class="col">
                                    <label for="jenis_kelamin" class="mb-1">Jenis Kelamin</label>
                                    <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                                        <option value="{{$user['jenis_kelamin']}}">{{$user['jenis_kelamin'] == 1 ? 'Laki-laki':'Perempuan'}}</option>
                                        <option value="1">Laki-laki</option>
                                        <option value="0">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col">
                                    <label for="" class="mb-1">Tempat Lahir</label>
                                    <input required name="tempat_lahir" type="text" class="form-control"
                                           aria-label="" value="{{$user['tempat_lahir']}}">
                                </div>
                                <div class="col">
                                    <label for="" class="mb-1">Tanggal Lahir</label>
                                    <input required name="tgl_lahir" type="date" class="form-control"
                                           aria-label="" value="{{$user['tgl_lahir']}}">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col">
                                    <label for="" class="mb-1">Golongan Darah</label>
                                    <input required name="gol_darah" type="text" class="form-control"
                                           aria-label="" value="{{$user['gol_darah']}}">
                                </div>
                                <div class="col">
                                    <label for="" class="mb-1">Agama</label>
                                    <input required name="agama" type="text" class="form-control"
                                           aria-label="" value="{{$user['agama']}}">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col">
                                    <label for="" class="mb-1">Alamat</label>
                                    <input required name="alamat" type="text" class="form-control"
                                           aria-label="" value="{{$user['alamat']}}">
                                </div>
                                <div class="col">
                                    <label for="" class="mb-1">No. Telepon</label>
                                    <input required name="notlp" type="text" class="form-control"
                                           aria-label="" value="{{$user['notlp']}}">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col">
                                    <label for="" class="mb-1">NIP</label>
                                    <input required name="nip" type="text" class="form-control"
                                           aria-label="" value="{{$user['nip']}}">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col">
                                    <label for="" class="mb-1">Update Password</label>
                                    <input name="password" type="password" class="form-control"
                                           aria-label="">
                                </div>
                            </div>
                        </div>
                        <input name="role" hidden value="{{$user['role']}}">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </div>
                    </form>
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
@endsection
