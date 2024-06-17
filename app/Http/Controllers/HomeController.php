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
        //Get Total Obat
        $urlObat = "{$this->apiUrl}/obats";
        $responseObat = Http::get($urlObat)->json();
        $obats = count($responseObat['data']) ?? 0;

        //Get total suplier
        $urlSuplier = "{$this->apiUrl}/supliers";
        $responseSuplier = Http::get($urlSuplier)->json();
        $supliers = count($responseSuplier['data']) ?? 0;

        //get total pegawai
        $urlUser = "{$this->apiUrl}/users";
        $responseUsers = Http::get($urlUser)->json();
        $users = count($responseUsers['data']) ?? 0;

        return view('pages.home', [
            'obats' => $obats,
            'supliers' => $supliers,
            'users'=> $users
        ]);
    }
}
