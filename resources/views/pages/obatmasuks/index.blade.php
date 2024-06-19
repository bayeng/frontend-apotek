@extends('layouts.index')

@section('content')
<div class="">
    <h1>Obat Masuk</h1>
    <p class="text-secondary d-flex ">
        Dashboard / <span class="ms-1 text-dark"> Obat Masuk</span>
    </p>
    <div class="border p-3 me-3 shadow-sm rounded bg-white">
        {{-- <a href="{{route('add-suplier')}}" class="btn btn-primary justify-content-end mb-3">+ Tambah
            Suplier</a>--}}
        <button type="button" class="btn btn-primary justify-content-end mb-3" data-bs-toggle="modal"
            data-bs-target="#exampleModal">
            + Obat Masuk
        </button>

        <table class="table table-bordered" id="obatmasuk-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal Datang</th>
                    <th>Jumlah</th>
                    <th>suplier</th>
                    <th>Penerima</th>
                    <th>Obat</th>

                </tr>
            </thead>
            <tbody>
                @foreach($obatMasuks as $item)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$item['tgl_datang']}}</td>
                    <td>{{$item['jumlah']}}</td>
                    <td>{{$item['suplier']['nama']}}</td>
                    <td>{{$item['user']['nama']}}</td>
                    <td>{{$item['obat']['nama']}}</td>
                    {{-- <td class="text-start">{{ \Carbon\Carbon::parse($item['created_at'])->format('Y-m-d') }}</td>
                    --}}

                    {{-- <td class="text-center">--}}
                        {{-- <form action="{{ route('delete-suplier',  $item['id']) }}" method="POST" --}} {{--
                            style="display:inline;">--}}
                            {{-- <a href="{{route('detail-suplier', $item['id'])}}" class="btn btn-warning">Edit</a>--}}
                            {{-- @csrf--}}
                            {{-- @method('DELETE')--}}
                            {{-- <button type="submit" class="btn btn-danger"><i class="bi-trash"></i></button>--}}
                            {{-- </form>--}}
                        {{-- </td>--}}
                </tr>
                @endforeach
            </tbody>
        </table>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Obat Masuk</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="" method="post" action="{{route('store-obatmasuk')}}">
                            @csrf
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col">
                                        <label for="" class="mb-1">Tanggal Datang</label>
                                        <input name="tgl_datang" type="date" class="form-control"
                                            placeholder="{{now()}}" aria-label="First name">
                                    </div>
                                    <div class="col">
                                        <label for="alamat" class="mb-1">Jumlah</label>
                                        <input required name="jumlah" type="text" class="form-control"
                                            placeholder="Jumlah Obat" aria-label="Last name">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="" class="mb-1">Suplier</label>
                                    <select class="form-control" id="suplier" name="id_suplier">
                                        @foreach($supliers as $suplier)
                                        <option value="{{$suplier['id']}}">{{$suplier['nama']}}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="id_label_single">
                                        Penerima
                                    </label>
                                    <select name="id_penerima" class="js-example-theme-single js-states form-control"
                                        id="id_label_single">
                                        @foreach($users as $user)
                                        <option value="{{$user['id']}}">{{$user['nama']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="" class="mb-1">Obat</label>
                                    <select required name="id_obat" type="text" class="form-control"
                                        aria-label="Last name">
                                        @foreach($obats as $obat)
                                        <option value="{{$obat['id']}}">{{$obat['nama']}}</option>
                                        @endforeach
                                    </select>
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

@push('scripts')
<script type="module">
    $(document).ready(function() {
        $('#obatmasuk-table').DataTable({
            theme: 'bootstrap-5'
        });

    });
</script>
@endpush
