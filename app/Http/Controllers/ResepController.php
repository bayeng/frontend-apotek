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
        return view('pages.resep.index');
    }

    public function store(Request $request)
    {
        $url = env('API_URL') . '/obatkeluars';
        $data = $request->only([
            'id_user', 'id_tujuan', 'total_harga', 'nama_obat', 'jumlah', 'harga'
        ]);

        $response = Http::post($url, $data);
        if (!$response) {
            dd($response);
        }

        return redirect()->to('apotek');

    }
}