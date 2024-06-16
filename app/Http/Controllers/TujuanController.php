<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TujuanController extends Controller
{
    protected $apiUrl;

    public function __construct()
    {
        $this->apiUrl = config('services.api.url');
    }

    public function index()
    {
        $url = "{$this->apiUrl}/tujuans";
        $response = Http::get($url)->json();

        if ($response['success']){
            $data = $response;

        } else {
            $data = [];
        }
        $tujuans = $data['data'] ?? [];

        return view('pages.tujuans.index', [
            'tujuans'=>$tujuans
        ]);
    }

    public function store(Request $request)
    {
        $url = "{$this->apiUrl}/tujuans";
        $data = $request->all();
        $response = Http::post($url, $data)->json();
        if (!$response['success']) {
            session()->flash('error', 'Nama Tujuan Sudah Ada');
            return redirect()->to('tujuans');
        }

        session()->flash('success', 'Berhasil menambahkan data');
        return redirect()->to('tujuans');
    }

    public function destroy($id)
    {
        $url = "{$this->apiUrl}/tujuans/{$id}";
        $response = Http::delete($url)->json();

        if (!$response['success']){
            session()->flash('error', 'Gagal Menghapus Tujuan');
            return redirect()->to('tujuans');
        }

        session()->flash('success', 'Berhasil Menghapus data');
        return redirect()->to('tujuans');
    }
}
