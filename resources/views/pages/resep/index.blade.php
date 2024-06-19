@extends('layouts.index')

@section('content')

<div class="">
    <div class="d-flex justify-content-between align-items-center me-3">
        <h1>Apotek</h1>
        <a href="/apotek/riwayat" class="btn btn-primary"><i class="bi bi-hourglass-split"></i> Riwayat Transaksi</a>
    </div>
    <p class="text-secondary d-flex">
        Dashboard / <span class="ms-1 text-dark"> Apotek</span>
    </p>
    <div class="border p-3 me-3 shadow-sm rounded bg-white">
        <form action="{{ route('apotek.store') }}" method="POST">
            @csrf
            <input required name="id_user" type="number" class="form-control" id="id_user" placeholder="ID User"
                value="2" hidden>

            <div class="mb-3">
                <p class="mb-2 fw-medium">Tujuan</p>
                <select name="id_tujuan" id="tujuan" class="form-control">
                    <option value="">Pilih Tujuan</option>

                    @foreach ($tujuans as $tujuan)
                    <option value="{{$tujuan['id']}}">{{$tujuan['nama']}}</option>
                    @endforeach
                </select>
            </div>

            <div id="resep">
                <div class="d-flex justify-content-between align-items-end mb-3">
                    <p class="mb-0 fw-medium">Resep Obat</p>

                    <button type="button" id="add-obat" class="btn btn-primary"><i class="bi-plus-circle"></i> Tambah
                        Obat</button>
                </div>
                <div class="mb-2 d-flex gap-3 data_resep" id="0">
                    <div class="w-50">
                        <select name="nama_obat[]" class="form-control id_obat">
                            <option value="">Pilih Obat</option>

                            @foreach ($obats as $obat)
                            <option value="{{$obat['id']}}">{{$obat['nama']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="number" name="jumlah[]" class="form-control w-25 qty" placeholder="Kuantitas">
                    <input type="number" class="form-control w-25 harga_barang" placeholder="Harga"
                        style="display:none;">
                    <input type="number" name="harga[]" class="form-control w-25 harga" placeholder="Harga">
                    <button type="button" class="btn btn-danger delete" data-id="0"><i class="bi-trash"></i></button>
                </div>
            </div>

            <div class="mb-3 d-flex justify-content-between align-items-center gap-3">
                <p class="mb-2 fw-medium w-75 text-end">Total Harga</p>
                <input type="number" name="total_harga" class="form-control w-25" id="total_harga" readonly>
            </div>
            <button type="submit" class="btn btn-success mt-3">Simpan Data</button>
        </form>
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
        function calculateTotalHarga() {
            let total = 0;
            $('#resep .data_resep').each(function() {
                let harga = Number($(this).find('.harga').val());
                total += harga;
            });
            $('#total_harga').val(total);
        }

        $('#add-obat').on('click', function() {
            let newId = $('#resep').children().length;
            $('#resep').append(`
                <div class="mb-2 d-flex gap-3 data_resep" id="`+newId+`">
                    <div class="w-50">
                        <select name="nama_obat[]" class="form-control id_obat">
                            <option value="">Pilih Obat</option>

                            @foreach ($obats as $obat)
                            <option value="{{$obat['id']}}">{{$obat['nama']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="number" name="jumlah[]" class="form-control w-25 qty" placeholder="Kuantitas">
                    <input type="number" class="form-control w-25 harga_barang" placeholder="Harga" style="display:none;">
                    <input type="number" name="harga[]" class="form-control w-25 harga" placeholder="Harga">
                    <button type="button" class="btn btn-danger delete" data-id="`+newId+`"><i class="bi-trash"></i></button>
                </div>
            `);
        });

        $('#resep').on('click', '.delete', function() {
            let id = $(this).data('id');
            $('#'+id).remove();
            calculateTotalHarga();
        });

        $('#resep').on('change', '.id_obat', function() {
            let $row = $(this).closest('.data_resep');
            let id = $(this).val();

            $.ajax({
                url: "{{ env('API_URL') }}/obats/" + id,
                method: 'GET',
                success: function(data) {
                    $row.find('.qty').val(1);
                    $row.find('.harga_barang').val(data.data.harga_jual);
                    $row.find('.harga').val(data.data.harga_jual);
                    calculateTotalHarga();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });

        $('#resep').on('input', '.qty', function() {
            let $row = $(this).closest('.data_resep');
            let qty = Number($(this).val());
            let hargaBarang = Number($row.find('.harga_barang').val());
            $row.find('.harga').val(qty * hargaBarang);
            calculateTotalHarga();
        });
    });
</script>

@endpush
