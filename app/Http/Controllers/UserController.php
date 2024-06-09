<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    protected $apiUrl;

    public function __construct()
    {
        $this->apiUrl = config('services.api.url');
    }

    public function index()
    {
        $response = Http::get("{$this->apiUrl}/users");
        $data = $response->json();

        return view('pages.users.index', [
            'users'=>$data['data']
        ]);

    }

    public function show($id)
    {
        $response = Http::get("{$this->apiUrl}/users/{$id}");

        $data = $response->json();

        return view('pages.users.detail', [
            'user'=>$data['data']
        ]);
    }
}
