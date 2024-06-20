<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ResepController extends Controller
{
    protected $apiUrl;
    public function __construct()
    {
        $this->apiUrl = config('services.api.url');
    }

    public function index()
    {
        $url = "{$this->apiUrl}/obatkeluars";
        $response = Http::get($url);
        if ($response->successful()) {
            $data = $response->json();
            $obatkeluars = $data['data'] ?? [];
        } else {
            $obatkeluars = [];
        }

        return view('pages.resep.list', [
            'obatkeluars' => $obatkeluars
        ]);
    }

    public function show($id)
    {
        $url = "{$this->apiUrl}/obatkeluars/{$id}";
        $response = Http::get($url);
        $data = $response->json();

        return view('pages.resep.index', [
            'suplier' => $data['data']
        ]);
    }

    public function create() {
        $tujuans = Http::get($this->apiUrl . '/tujuans')->json();
        if ($tujuans['success']){
            $dataTujuans = $tujuans;

        } else {
            $dataTujuans = [];
        }
        $tujuans = $dataTujuans['data'] ?? [];

        $obats = Http::get($this->apiUrl . '/obats')->json();
        if ($obats['success']){
            $dataObats = $obats;
        } else {
            $dataObats = [];
        }
        $obats = $dataObats['data'] ?? [];
        return view('pages.resep.index', [
            'tujuans' => $tujuans,
            'obats' => $obats
        ]);
    }

    public function store(Request $request)
    {
        $url = "{$this->apiUrl}/obatkeluars";
        $validatedData = $request->all();
        // dd($validatedData);
        $response = Http::post($url, $validatedData);
        if (!$response['success']) {
            session()->flash('error', 'Transaksi gagal :' . $response['message']);
            return redirect()->back()->withInput($request->all());
        } else {
            session()->flash('success', 'Transaksi berhasil');
        }

        return redirect()->to('apotek');

    }
}