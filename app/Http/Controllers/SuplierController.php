<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SuplierController extends Controller
{
    protected $apiUrl;
    public function __construct()
    {
        $this->apiUrl = config('services.api.url');
    }

    public function index()

    {
        $url = "{$this->apiUrl}/supliers"; //{http://localhost:8000/api}
        $response = Http::get($url);
        if ($response->successful()) {
            $data = $response->json();
            $supliers = $data['data'] ?? [];
        } else {
            $supliers = [];
        }

        return view('pages.supliers.index', [
            'supliers' => $supliers
        ]);
    }

    public function show($id)
    {
        $url = "{$this->apiUrl}/supliers/{$id}";
        $response = Http::get($url);
        $data = $response->json();

        return view('pages.supliers.detail', [
            'suplier' => $data['data']
        ]);
    }

    public function store(Request $request)
    {
        $url = "{$this->apiUrl}/supliers";
        $data = $request->only([
            'nama', 'alamat', 'kota', 'notlp', 'nama_bank', 'no_rekening'
        ]);

        $response = Http::post($url, $data);
        if ($response->failed()) {
            dd($response);
        }

        session()->flash('success', 'Data  berhasil dibuat.');

        return redirect()->route('supliers');

    }

    public function update(Request $request, $id)
    {
        $url = "{$this->apiUrl}/supliers/{$id}";
        $data = $request->all();
        $response = Http::patch($url, $data)->json();
        if (!$response['success']) {
            $data = $request->except(['nama']);
            $response = Http::patch($url, $data)->json();
        }

        session()->flash('success', 'Data  berhasil diperbarui.');
        return redirect()->route('detail-suplier', $id);
    }

    public  function destroy($id)
    {
        $url = "{$this->apiUrl}/supliers/{$id}";
        $response = Http::delete($url)->json();
        if (!$response['success']) {
            session()->flash('error', 'Gagal Menghapus Karena suplier Berkaitan dengan obat masuk.');
        } else {
            session()->flash('success', 'Data  berhasil dihapus.');
        }
        return redirect()->route('supliers');
    }
}
