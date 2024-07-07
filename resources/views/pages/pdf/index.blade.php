
<!doctype html>
<html lang="en">
<head>
   @include('includes.head')
    @php
        if (!function_exists('formatRupiah')) {
            function formatRupiah($number)
            {
                $fmt = new NumberFormatter('id_ID', NumberFormatter::CURRENCY);
                return $fmt->formatCurrency($number, 'IDR');
            }
        }
    @endphp
    <style>
        .font-bold {
            font-weight: bold;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .text-primary {
            color: #007bff;
        }
        .p-3 {
            padding: 1rem;
        }
        .my-3 {
            margin-top: 1rem;
            margin-bottom: 1rem;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body class="p-3">
    <h1 class=" text-primary">APOTEK RSU</h1>
    <p class="my-3">LAPORAN HARIAN OBAT YANG TERJUAL</p>

    <p>Tanggal: {{$today}}</p>

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Nama Karyawan</th>
            <th>Tujuan</th>
            <th>Obat</th>
            <th>Total</th>
        </tr>
        @foreach($transaksi as $item)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$item['nama_user']}}</td>
                <td>{{$item['nama_tujuan']}}</td>
                <td>
                    @foreach($item['riwayat_obat'] as $obat)
                        {{$obat['nama_obat']}} = {{$obat['jumlah']}}
                        <br>
                    @endforeach
                </td>
                <td>{{ formatRupiah($item['total_harga']) }}</td>
            </tr>
        @endforeach
    </table>
    <p class="my-3 font-bold">Total Pendapatan = {{formatRupiah($omzet)}}</p>
</body>
</html>
