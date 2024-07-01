<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ResepController extends Controller
{
    protected $apiUrl;
    public function __construct()
    {
        $this->apiUrl = config('services.api.url');
    }

    public function index()
    {
        $url = "{$this->apiUrl}/obatkeluars";
        $response = Http::get($url);
        if ($response->successful()) {
            $data = $response->json();
            $obatkeluars = $data['data'] ?? [];
        } else {
            $obatkeluars = [];
        }

        return view('pages.resep.list', [
            'obatkeluars' => $obatkeluars
        ]);
    }

    public function show($id)
    {
        $url = "{$this->apiUrl}/obatkeluars/{$id}";
        $response = Http::get($url);
        $data = $response->json();

        return view('pages.resep.index', [
            'suplier' => $data['data']
        ]);
    }

    public function create() {
        $tujuans = Http::get($this->apiUrl . '/tujuans')->json();
        if ($tujuans['success']){
            $dataTujuans = $tujuans;

        } else {
            $dataTujuans = [];
        }
        $tujuans = $dataTujuans['data'] ?? [];

        $obats = Http::get($this->apiUrl . '/obats')->json();
        if ($obats['success']){
            $dataObats = $obats;
        } else {
            $dataObats = [];
        }
        $obats = $dataObats['data'] ?? [];
        return view('pages.resep.index', [
            'tujuans' => $tujuans,
            'obats' => $obats
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_user' => 'required|integer',
            'id_tujuan' => 'required|integer',
            'total_harga' => 'required|numeric',
            'catatan' => 'nullable|string',
            'nama_obat.*' => 'required|string',
            'jumlah.*' => 'required|integer|min:1',
            'harga.*' => 'required|numeric|min:1',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        $nama_obat = $validatedData['nama_obat'];
        $jumlah = $validatedData['jumlah'];
        $harga = $validatedData['harga'];
        try {
            $client = new Client();
            $image = $request->file('image');
            $imageContents = file_get_contents($image->getRealPath());
            $imageName = $image->getClientOriginalName();

            $formData = [
                [
                    'name' => 'id_user',
                    'contents' => $validatedData['id_user']
                ],
                [
                    'name' => 'id_tujuan',
                    'contents' => $validatedData['id_tujuan']
                ],
                [
                    'name' => 'total_harga',
                    'contents' => $validatedData['total_harga']
                ],
                [
                    'name' => 'catatan',
                    'contents' => $validatedData['catatan']
                ],
                [
                    'name' => 'image',
                    'contents' => $imageContents,
                    'filename' => $imageName,
                ],
            ];
            foreach ($nama_obat as $index => $nama) {
                $formData[] = [
                    'name' => 'nama_obat[]',
                    'contents' => $nama,
                ];
                $formData[] = [
                    'name' => 'jumlah[]',
                    'contents' => $jumlah[$index],
                ];
                $formData[] = [
                    'name' => 'harga[]',
                    'contents' => $harga[$index],
                ];
            }

            $response = $client->request('POST', "{$this->apiUrl}/obatkeluars", ['multipart' => $formData]);
            $statusCode = $response->getStatusCode();
            $body = $response->getBody()->getContents();

            if ($statusCode == 200) {
                session()->flash('success', 'Transaksi sukses');
                return redirect()->to('/apotek');
            } else {
                session()->flash('error', 'Transaksi gagal');
                return redirect()->back()->withInput();
            }
        } catch (RequestException $e) {
            return response()->json(['success' => false, 'message' => 'Gagal mengirim permintaan: ' . $e->getMessage()]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
}