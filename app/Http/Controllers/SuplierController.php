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
        $response = Http::get(env('API_URL') . '/supliers');
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
        $url = env('API_URL') . '/supliers';
        $data = $request->only([
            'nama', 'alamat', 'kota', 'notlp', 'nama_bank', 'no_rekening'
        ]);

        $response = Http::post($url, $data);

        if (!$response) {
            dd($response);
        }

        return redirect()->to('supliers');

    }

    public function update(Request $request, $id)
    {
        $url = "{$this->apiUrl}/supliers/{$id}";
        $data = $request->all();
        $response = Http::patch($url, $data);
        if (!$response) {
            dd($response);
        }

        return redirect()->to('supliers');
    }

    public  function destroy($id)
    {
        $url = env('API_URL') . '/supliers/' . $id;
        $response = Http::delete($url);
        if (!$response) {
            dd($response);
        }
        return redirect()->to('supliers');
    }
}