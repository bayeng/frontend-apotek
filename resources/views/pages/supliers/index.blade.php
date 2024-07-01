@extends('layouts.index')

@section('content')
<div class="">
    <h1>Suplier</h1>
    <p class="text-secondary d-flex ">
        Dashboard / <span class="ms-1 text-dark"> Suplier</span>
    </p>
    <div class="border p-3 me-3 shadow-sm rounded bg-white">
        {{-- <a href="{{route('add-suplier')}}" class="btn backround-blue justify-content-end mb-3">+ Tambah
            Suplier</a>--}}
        <button type="button" class="btn backround-blue justify-content-end mb-3" data-bs-toggle="modal"
            data-bs-target="#exampleModal">
            + Tambah Suplier
        </button>

        <table class="table table-bordered" id="suppliers-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Kota</th>
{{--                    <th class="text-start">Dibuat Pada</th>--}}
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($supliers as $item)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$item['nama']}}</td>
                    <td>{{$item['alamat']}}</td>
                    <td>{{$item['kota']}}</td>
{{--                    <td class="text-start">{{ \Carbon\Carbon::parse($item['created_at'])->format('Y-m-d') }}</td>--}}
                    <td class="text-center" width="20%">
                        <form action="{{ route('delete-suplier',  $item['id']) }}" method="POST"
                            class="col">
                            <a href="{{route('detail-suplier', $item['id'])}}" class="btn backround-yellow">Detail</a>
                            @csrf
                            @method('DELETE')
                            <button type="button" onclick="confirmDelete(event)" class="btn backround-red">Hapus</button>
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
                                        <input required name="nama" type="text" class="form-control"
                                            placeholder="Nama Suplier" aria-label="First name">
                                    </div>
                                    <div class="col">
                                        <label for="alamat" class="mb-1">Alamat</label>
                                        <input required name="alamat" type="text" class="form-control"
                                            placeholder="Alamat" aria-label="Last name">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label for="" class="mb-1">Kota</label>
                                        <input required name="kota" type="text" class="form-control" placeholder="Kota"
                                            aria-label="First name">
                                    </div>
                                    <div class="col">
                                        <label for="" class="mb-1">No tlp.</label>
                                        <input required name="notlp" type="text" class="form-control"
                                            placeholder="No tlp." aria-label="Last name">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label for="" class="mb-1">Nama Bank</label>
                                        <input required name="nama_bank" type="text" class="form-control"
                                            placeholder="Nama Bank" aria-label="First name">
                                    </div>
                                    <div class="col">
                                        <label for="" class="mb-1">No. Rekening</label>
                                        <input required name="no_rekening" type="text" class="form-control"
                                            placeholder="No. Rekening" aria-label="Last name">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn backround-blue">Tambah</button>
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
{{--<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>--}}
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
        $('#suppliers-table').DataTable({
            theme: 'bootstrap-5',

        });
    });
</script>

@endsection
