<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    protected $apiUrl;

    public function __construct()
    {
        $this->apiUrl = config('services.api.url');
    }

    public function index()
    {
        $transaksimasuk = Http::get("{$this->apiUrl}/transaksimasuk")->json();
        $transaksikeluar = Http::get("{$this->apiUrl}/transaksikeluar")->json();
        $omzet = Http::get("{$this->apiUrl}/omzet")->json();
        $dangerstok = Http::get("{$this->apiUrl}/dangerstok")->json();

        return view('pages.home', [
            'transaksimasuk' => $transaksimasuk['data'],
            'transaksikeluar' => $transaksikeluar['data'],
            'omzet'=> $omzet['data'],
            'dangerstok'=> $dangerstok['data']
        ]);
    }
}