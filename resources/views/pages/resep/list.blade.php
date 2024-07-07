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
    <div class="d-flex justify-content-between align-items-center me-3">
        <h1>Riwayat Transaksi</h1>
        <a href="{{route('generate-pdf')}}" class="btn btn-secondary"><span class="bi bi-file-pdf"></span> Cetak Laporan</a>
    </div>
    <p class="text-secondary">
        Dashboard / Apotek / <span class="ms-1 text-dark"> Riwayat</span>
    </p>

    <div class="border p-3 me-3 shadow-sm rounded bg-white">
        <table class="table table-bordered" id="table-user">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Karyawan</th>
                    <th>Tujuan</th>
                    <th>Total Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($obatkeluars as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item['nama_user']}}</td>
                    <td>{{ $item['nama_tujuan'] }}</td>
                    <td>{{ formatRupiah($item['total_harga']) }}</td>
                    <td class="text-center">
                        <button type="button" class="btn btn-primary show" data-bs-toggle="modal"
                            data-bs-target="#exampleModal" data-id="{{ $item['id'] }}"><i
                                class="bi bi-eye-fill"></i></button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- modal --}}
<div class="modal fade" id="exampleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Transaksi</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <p class="mb-2 fw-medium">Nama Karyawan</p>
                    <input type="text" class="form-control" id="user" readonly>
                </div>
                <div class="mb-3">
                    <p class="mb-2 fw-medium">Tujuan</p>
                    <input type="text" class="form-control" id="tujuan" readonly>
                </div>

                <div id="resep">
                    <p class="mb-0 fw-medium">Resep Obat</p>
                </div>

                <div class="mb-3 d-flex justify-content-between align-items-center gap-3">
                    <p class="mb-2 fw-medium w-75 text-end">Total Harga</p>
                    <input type="number" name="total_harga" class="form-control w-25" id="total_harga" readonly>
                </div>

                <div class="mb-3">
                    <label for="catatan" class="form-label">Catatan</label>
                    <textarea name="catatan" id="catatan" cols="30" rows="10" class="form-control" readonly></textarea>
                </div>

                <div id="image" class="mb-3 w-100">
                    <img src="" class="w-100" alt="Resep Obat">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
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
        $('#table-user').DataTable();

        $('.show').on('click', function() {
            let id = $(this).data('id')
            let urlApi = '{{ env('API_URL') }}'
            let urlImage = '{{ env('API_IMAGE') }}'
            $('#resep').html('');

            $.ajax({
                url: urlApi + "/obatkeluars/" + id,
                method: 'get',
                success: function(data) {
                    console.log(data);
                    $('#user').val(data.data.nama_user),
                    $('#tujuan').val(data.data.nama_tujuan)
                    $('#total_harga').val(data.data.total_harga)

                    $('#catatan').val(data.data.catatan)
                    $('#image img').attr('src', urlImage + data.data.image)

                    $('#resep').html(`
                    <p class="mb-0 fw-medium">Resep Obat</p>
                    `)
                    data.data.riwayat_obat.forEach(item => {
                        $('#resep').append(`
                            <div class="mb-2 d-flex gap-3 data_resep">
                                <input type="text" class="form-control w-50 obat" readonly value="${item.nama_obat}">
                                <input type="number" class="form-control w-25 qty" readonly value="${item.jumlah}">
                                <input type="number" class="form-control w-25 harga" readonly value="${item.harga}">
                            </div>
                        `)
                    });
                }
            })
        })

        $('#exampleModal').on('hidden.bs.modal', function() {
            $('#user').val('')
            $('#tujuan').val('')
        })
    })
</script>

@endpush
