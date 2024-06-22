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

    public function login () {
        return view('pages.auth');
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
        if (!$data['success']) {
            dd($data);
        }

        return view('pages.users.detail', [
            'user'=>$data['data']
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $url = "{$this->apiUrl}/users";
        $data['jenis_kelamin'] == '1' ? 1 : 0;
        $response = Http::post($url, $data)->json();
        if (!$response['success']) {
            dd($response);
        }

        return redirect()->to('users');
    }

    public function update(Request $request, $id)
    {
        $url = "{$this->apiUrl}/users/{$id}";

        $data = $request->except('username');
        $data['jenis_kelamin'] == '1' ? 1 : 0;
        $oldData = Http::get($url)->json();


        if ($data['password'] == null) {
            $data = $request->except(['password']);

        }

        $response = Http::patch($url, $data)->json();
        if (!$response['success']) {
            dd($response);
        }

        session()->flash('success', 'berhasil edit data');
        return redirect()->route('detail-user', $id);
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