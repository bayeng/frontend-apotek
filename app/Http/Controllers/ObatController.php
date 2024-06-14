<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ObatController extends Controller
{
    protected $apiUrl;
    public function __construct()
    {
        $this->apiUrl = config('services.api.url');
    }

    public function index()
    {
        $url = "{$this->apiUrl}/obats";
        $response = Http::get($url);
        if ($response->successful()) {
            $data = $response->json();
            $obats = $data['data'] ?? [];
        } else {
            $obats = [];
        }

        return view('pages.obats.index', [
            'obats' => $obats
        ]);
    }

    public function show($id)
    {
        $url = "{$this->apiUrl}/obats/{$id}";
        $response = Http::get($url);
        $data = $response->json();

        return view('pages.obats.detail', [
            'suplier' => $data['data']
        ]);
    }

    public function store(Request $request)
    {
        $url = env('API_URL') . '/obats';
        $data = $request->only([
            'nama', 'jenis_obat', 'harga_jual', 'harga_beli', 'stok'
        ]);

        $response = Http::post($url, $data);
        if (!$response) {
            dd($response);
        }

        return redirect()->to('obats');

    }

    public function update(Request $request, $id)
    {
        $url = "{$this->apiUrl}/obats/{$id}";
        $data = $request->all();
        $response = Http::patch($url, $data);
        if (!$response) {
            dd($response);
        }

        return redirect()->to('obats');
    }

    public function destroy($id)
    {
        $url = env('API_URL') . '/obats/' . $id;
        $response = Http::delete($url);
        if (!$response) {
            dd($response);
        }
        return redirect()->back();
    }
}