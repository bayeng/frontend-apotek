@extends('layouts.index')

@section('content')
    @php
        if (!function_exists('formatRupiah')) {
            function formatRupiah($number)
            {
                $fmt = new NumberFormatter('id_ID', NumberFormatter::CURRENCY);
                return $fmt->formatCurrency($number, 'IDR');
            }
        }
    @endphp
<div class="">
    <h1>Obat</h1>
    <p class="text-secondary d-flex ">
        Dashboard / <span class="ms-1 text-dark"> Obat</span>
    </p>
    <div class="border p-3 me-3 shadow-sm rounded bg-white">
        <button type="button" class="btn btn-primary justify-content-end mb-3" data-bs-toggle="modal"
            data-bs-target="#exampleModal" id="add">
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
                @foreach ($obats as $item)
                <tr
                    class="{{ $item['stok'] < 10 ? 'table-danger' : '' }} {{ $item['stok'] < 20 ? 'table-warning' : '' }}">
                    <td>{{$loop->iteration}}</td>
                    <td>{{$item['nama']}}</td>
                    <td>{{$item['jenis_obat']}}</td>
                    <td>{{formatRupiah($item['harga_jual'])}}</td>
                    <td>{{formatRupiah($item['harga_jual'])}}</td>
                    <td>{{$item['stok']}}</td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center align-items-center gap-2">
                            <button type="button" data-id="{{ $item['id'] }}" class="btn btn-warning edit text-white"
                                data-bs-toggle="modal" data-bs-target="#exampleModal">Edit</button>
                            <form method="POST" action="{{ route('obat.destroy', $item['id']) }}">
                                @csrf
                                @method("DELETE")
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Obat</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="" method="post" action="{{ route('obat.store') }}" id="obat-form">
                            @csrf
                            <div class="mb-3">
                                <label for="nama" class="mb-1">Nama Obat</label>
                                <input required name="nama" type="text" class="form-control" placeholder="Nama Obat"
                                    id="nama">
                            </div>
                            <div class="mb-3">
                                <label for="jenis_obat" class="mb-1">Jenis Obat</label>
                                <input required name="jenis_obat" type="text" class="form-control"
                                    placeholder="Jenis Obat" id="jenis_obat">
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="harga_jual" class="mb-1">Harga Jual</label>
                                    <input required name="harga_jual" type="number" class="form-control"
                                        placeholder="Harga Jual" id="harga_jual">
                                </div>
                                <div class="col">
                                    <label for="harga_beli" class="mb-1">Harga Beli</label>
                                    <input required name="harga_beli" type="number" class="form-control"
                                        placeholder="Harga Beli" id="harga_beli">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="stok" class="mb-1">Stok</label>
                                <input required name="stok" type="number" class="form-control" placeholder="Stok"
                                    id="stok">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" id="submit" class="btn btn-primary">Tambah</button>
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
        $('.logout').on('click', function() {
            localStorage.removeItem('user')
            window.location.href = '/login'
        })

        $('#table-user').DataTable();

        $(document).on('click', '.edit', function() {
            let apiUrl = "{{ env('API_URL') }}";
            let id = $(this).data('id');

            $('#obat-form').attr('action', '{{ url("obats") }}/' + id);
            $('#obat-form').attr('method', 'POST');
            $('<input>').attr({
                type: 'hidden',
                name: '_method',
                value: 'PATCH'
            }).appendTo('#obat-form');
            $('#exampleModalLabel').text('Edit Data Obat')
            $('#submit').text('Edit')

            $.ajax({
                url: apiUrl + '/obats/' + id,
                method: 'GET',
                success: function(data) {
                    console.log(data);
                    $('#nama').val(data.data.nama);
                    $('#jenis_obat').val(data.data.jenis_obat);
                    $('#harga_jual').val(data.data.harga_jual);
                    $('#harga_beli').val(data.data.harga_beli);
                    $('#stok').val(data.data.stok);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });

        $(document).on('click', '#add', function() {
            $('#obat-form').attr('action', '{{ url("obats") }}');
            $('#obat-form').attr('method', 'POST');
            $('<input>').attr({
            type: 'hidden',
            name: '_method',
            value: 'POST'
            }).appendTo('#obat-form');
            $('#exampleModalLabel').text('Tambah Data Obat')
            $('#submit').text('Tambah')
            let form = $('#nama, #jenis_obat, #harga_jual, #harga_beli, #stok');
            form.val('');
        });
    });
</script>
@endsection
