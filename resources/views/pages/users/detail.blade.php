@extends('layouts.index')

@section('content')

    <div class="border bg-white shadow-sm rounded p-2 px-5 row justify-content-between align-items-center">
        <div class="col-auto">
            <h1>{{$user['nama']}}</h1>
        </div>
        <div class="col-auto">
            <a href="" class="btn-warning btn">Edit</a>
            <a href="" class="btn-secondary btn">Kembali</a>
        </div>
    </div>
    <div class="border bg-white shadow-sm rounded p-2 px-5 d-flex justify-content-between align-items-center mt-5">
        <table class="table">
            <tbody>
            <tr>
                <td>Jenis Kelamin</td>
                <td>:</td>
                <td>{{$user['jenis_kelamin']}}</td>
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
                <td>username</td>
                <td>:</td>
                <td>{{$user['username']}}</td>
            </tr>
            <tr>
                <td>Role</td>
                <td>:</td>
                <td>{{$user['role']}}</td>
            </tr>
            <tr>
                <td></td>
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

@endsection
