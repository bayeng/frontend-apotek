<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SuplierController extends Controller
{
    public function index()
    {
        $response = Http::get(env('API_URL') . '/suplier');
        $data = $response->json();

        return view('pages.supliers.index', [
           'supliers'=>$data['data']
        ]);
    }

    public function addPage()
    {
        return view('pages.add.add-suplier');
    }

    public function store(Request $request)
    {
        $url = env('API_URL') . '/suplier';
        $data = $request->only([
            'nama', 'alamat', 'kota', 'notlp', 'nama_bank', 'no_rekening'
        ]);

        $response = Http::post($url, $data);

        if (!$response) {
            dd($response);
        }

        return redirect()->to('supliers');

    }

    public  function destroy($id)
    {
        $url = env('API_URL') . '/suplier/' . $id;
        $response = Http::delete($url);
        if (!$response) {
            dd($response);
        }
        return redirect()->to('supliers');
    }
}
