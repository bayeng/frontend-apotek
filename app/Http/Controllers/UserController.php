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
        if ($response->successful()) {
            $data = $response->json();
            $users = $data['data'] ?? [];
        } else {
            $users = [];
        }

        return view('pages.users.index', [
            'users' => $users
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

    public function store(Request $request)
    {
        $data = $request->only([
            'nama','jenis_kelamin', 'tempat_lahir', 'tgl_lahir', 'gol_darah', 'agama', 'nip', 'username', 'password', 'nip', 'notlp', 'alamat'
        ]);
        $url = "{$this->apiUrl}/users";

        $response = Http::post($url, $data);
        if (!$response) {
            dd($response);
        }

        return redirect()->to('users');
    }

    public function update(Request $request, $id)
    {
        $url = "{$this->apiUrl}/users/{$id}";
        $data = $request->all();

        $response = Http::patch($url, $data);
        if (!$response) {
            dd($response);
        }

        return redirect()->to('detail-user');
    }

    public function destroy($id)
    {
        $url = "{$this->apiUrl}/users/{$id}";
        $response = Http::delete($url);
        if (!$response) {
            dd($response);
        }

        return redirect()->to('detail-user');
    }
}