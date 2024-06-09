@extends('layouts.index')

@section('content')

    <div class="border bg-white shadow-sm rounded p-2 px-5 row justify-content-between align-items-center">
        <div class="col-auto">
            <h1>{{$user['nama']}}</h1>
        </div>
        <div class="col-auto">
            <a href="" class="btn-secondary btn">Kembali</a>
        </div>
    </div>
    <div class="border bg-white shadow-sm rounded p-2 px-5 row justify-content-between align-items-center mt-5">
        <table class="table">
            <tbody>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td>:</td>
                    <td>{{$user['jenis_kelamin']}}</td>
                </tr>
                <tr>
                    <td>NIP</td>
                    <td>:</td>
                    <td>{{$user['nip']}}</td>
                </tr>
                <tr>
                    <td>NIP</td>
                    <td>:</td>
                    <td>{{$user['nip']}}</td>
                </tr>
                <tr>
                    <td>NIP</td>
                    <td>:</td>
                    <td>{{$user['nip']}}</td>
                </tr>
                <tr>
                    <td>NIP</td>
                    <td>:</td>
                    <td>{{$user['nip']}}</td>
                </tr>
                <tr>
                    <td>NIP</td>
                    <td>:</td>
                    <td>{{$user['nip']}}</td>
                </tr>
                <tr>
                    <td>NIP</td>
                    <td>:</td>
                    <td>{{$user['nip']}}</td>
                </tr>
                <tr>
                    <td>NIP</td>
                    <td>:</td>
                    <td>{{$user['nip']}}</td>
                </tr>
                <tr>
                    <td></td>
                    <td>:</td>
                    <td>{{$user['nip']}}</td>
                </tr>
                <tr>
                    <td>No. Telepon</td>
                    <td>:</td>
                    <td>{{$user['no_telp']}}</td>
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
