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
        $response = Http::get($url);

        if ($response->successful()){
            $data = $response->json();

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
        $response = Http::post($url, $data);

        if ($response->failed()) {
            dd($response);
        }
        return redirect()->to('tujuans');
    }

    public function destroy($id)
    {
        $url = "{$this->apiUrl}/tujuans/{$id}";
        $response = Http::delete($url);

        if ($response->failed()){
            dd($response);
        }

        return redirect()->to('tujuans');
    }
}
