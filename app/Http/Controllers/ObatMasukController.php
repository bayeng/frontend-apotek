<?php

namespace App\Http\Controllers;

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
        $response = Http::get($url);
        if ($response->successful()) {
            $data = $response->json();
            $obatMasuks = $data['data'] ?? [];
        } else {
            $obatMasuks = [];
        }

        // Data Relations
        $supliers = Http::get("{$this->apiUrl}/supliers");
        if ($supliers->successful()) {
            $data = $supliers->json();
            $supliers = $data['data'] ?? [];
        } else {
            $supliers = [];
        }

        $users = Http::get("{$this->apiUrl}/users");
        if ($users->successful()) {
            $data = $users->json();
            $users = $data['data'] ?? [];
        } else {
            $users = [];
        }

        $obats = Http::get("{$this->apiUrl}/obats");
        if ($obats->successful()) {
            $data = $obats->json();
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

        $requestForObat = $request->only(['id_obat', 'jumlah']);
        $responseObatMasuk = Http::post($url, $data);
//        dd($requestForObat);
//        $response = Http::post($url, $data);
        $urlObat = "{$this->apiUrl}/obats/{$requestForObat['id_obat']}";
        $findObat = Http::get($urlObat);

        $updateStokObat = $findObat->json()['data']['stok'] + $requestForObat['jumlah'];

        $responseObat = Http::patch($urlObat, [
            "stok" => $updateStokObat
        ]);

        return redirect()->to('obatmasuks');
    }
}
