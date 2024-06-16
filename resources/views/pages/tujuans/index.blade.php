@extends('layouts.index')

@section('content')
    <div class="">
        <h1>Tujuan</h1>
        <p class="text-secondary d-flex ">
            Dashboard / <span class="ms-1 text-dark"> Tujuan</span>
        </p>
        <div class="border p-3 me-3 shadow-sm rounded bg-white">
            {{-- <a href="{{route('add-suplier')}}" class="btn btn-primary justify-content-end mb-3">+ Tambah
                Suplier</a>--}}
            <button type="button" class="btn btn-primary justify-content-end mb-3" data-bs-toggle="modal"
                    data-bs-target="#exampleModal">
                + Tambah Tujuan
            </button>

            <table class="table table-bordered" id="suppliers-table">
                <thead>
                <tr>
                    <th width="5%">No</th>
                    <th >Tujuan</th>
                    <th width="15%">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($tujuans as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$item['nama']}}</td>
                        <td class="text-center">
                            <form action="{{ route('delete-tujuan',  $item['id']) }}" method="POST"
                                  style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="button" onclick="confirmDelete(event)" class="btn btn-danger">Hapus</button>
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
                            <form class="" method="post" action="{{route('store-tujuan')}}">
                                @csrf
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col">
                                            <label for="" class="mb-1">Nama Tujuan</label>
                                            <input required name="nama" type="text" class="form-control"
                                                   placeholder="Masukan Tujuan" aria-label="First name">
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
            $('#suppliers-table').DataTable({
                theme: 'bootstrap-5',

            });
        });

    </script>
@endsection
