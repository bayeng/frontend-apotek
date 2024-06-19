<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ObatMasukController extends Controller
{
    protected $apiUrl;

    public function __construct()
    {
        $this->apiUrl = config('services.api.url');
    }
    public function index()
    {
        $url = "{$this->apiUrl}/obatmasuks";
        $response = Http::get($url)->json();
        if ($response['success']) {
            $data = $response;
            $obatMasuks = $data['data'] ?? [];
        } else {
            $obatMasuks = [];
        }

        // Data Relations
        $supliers = Http::get("{$this->apiUrl}/supliers")->json();

        if ($supliers['success']) {
            $data = $supliers;
            $supliers = $data['data'] ?? [];
        } else {
            $supliers = [];
        }

        $users = Http::get("{$this->apiUrl}/users")->json();
        if ($users['success']) {
            $data = $users;
            $users = $data['data'] ?? [];
        } else {
            $users = [];
        }

        $obats = Http::get("{$this->apiUrl}/obats")->json();
        if ($obats['success']) {
            $data = $obats;
            $obats = $data['data'] ?? [];
        } else {
            $obats = [];
        }

        return view('pages.obatmasuks.index', [
            'obatMasuks'=>$obatMasuks,
            'users'=>$users,
            'obats'=>$obats,
            'supliers'=>$supliers
        ]);
    }

    public function storePage()
    {
        return view('pages.obatmasuks.add');
    }

    public function store(Request $request)
    {
        $url = "{$this->apiUrl}/obatmasuks";
        $data =$request->all();

        if ($data['tgl_datang'] === null) {
            $data['tgl_datang'] = now()->toDateTimeString();
        } else {
            $data['tgl_datang'] = $data['tgl_datang'] . ' ' . now()->toTimeString();
        }

        $responseObatMasuk = Http::post($url, $data);

        $requestForObat = $request->only(['id_obat', 'jumlah']);

        $urlObat = "{$this->apiUrl}/obats/{$requestForObat['id_obat']}";
        $findObat = Http::get($urlObat);

        $updateStokObat = $findObat->json()['data']['stok'] + $requestForObat['jumlah'];

        $responseObat = Http::patch($urlObat, [
            "stok" => $updateStokObat
        ]);

        return redirect()->to('obatmasuks');
    }
}
