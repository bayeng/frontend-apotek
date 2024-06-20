<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    protected $apiUrl;

    public function __construct()
    {
        $this->apiUrl = config('services.api.url');
    }

    public function index()
    {
        $response = Http::get("{$this->apiUrl}/users")->json();
        if ($response['success']) {
            $data = $response;
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

        $response = Http::post($url, $data)->json();
        if (!$response['success']) {
            dd($response);
        }

        return redirect()->to('users');
    }

    public function update(Request $request, $id)
    {
        $url = "{$this->apiUrl}/users/{$id}";
        $data = $request->all();

        $response = Http::patch($url, $data);

        if (!$response['success']) {
            dd($response);
        }

        return redirect()->to('detail-user');
    }

    public function destroy($id)
    {
        $url = "{$this->apiUrl}/users/{$id}";
        $response = Http::delete($url)->json();

        if (!$response['success']) {
            session()->flash('error', 'Gagal Menghapus Karena User Berkaitan dengan obat masuk.');
        } else {
            session()->flash('success', 'Data User berhasil dihapus.');
        }

        return redirect()->route('user');
    }
}