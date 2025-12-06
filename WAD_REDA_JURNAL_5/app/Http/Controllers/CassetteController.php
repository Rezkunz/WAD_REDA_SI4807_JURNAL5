<?php

namespace App\Http\Controllers;

use App\Models\Cassette;
use App\Http\Resources\CassetteResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use MessageFormatter;

class CassetteController extends Controller
{
    /**
     * ===========1================
     * Buat fungsi index yang mengembalikan semua data cassette
     */
    public function index()
    {
        $cassettes = Cassette::all();
        return CassetteResource::collection($cassette);
        // ambil semua data cassette
        // $cassettes = ....

        // return koleksi cassette
        // return ....
    }

    /**
     * ===========2================
     * Buat fungsi store untuk menambahkan data cassette baru
     */
    public function store(Request $request)
    {
        // Request body berisi title, artist dan year
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:225',
            'artist' => 'required|string|max:225',
            'year' => 'required|year',
            
        ]);

        if ($validator->fails()) {
            return response()->json([
                'messege' => 'cek your request lah',
                'errors' => $validator->errors()
            ], 422);
        }

        // Buat data cassette
        // $cassette = ....

        // return cassette yang dibuat sebagai resource
        // return ....

    }

    /**
     * ===========3================
     * Buat fungsi show untuk menampilkan satu data cassette berdasarkan ID
     */
    public function show(string $id)
    {
        // Cari data cassette berdasarkan ID
        // $cassette = ....

        if (!$cassette) {
            return response()->json([
                'messege' => 'cek your request lah',
                'errors' => $validator->errors()
            ], 404);
        }

        // return cassette sebagai resource
        // return ....
    }

    /**
     * ===========4================
     * Buat fungsi update untuk mengubah data cassette yang ada
     */
    public function update(Request $request, string $id)
    {
        // Request body berisi title, artist dan year
        $validator = Validator::make($request->all(), [
            
        ]);

        // Cari data cassette berdasarkan ID
        // $cassette = ....

        if (!$cassette) {
            return response()->json([
                'messege' => 'cek your request lah',
                'errors' => $validator->errors()
            ], 404);
        }


        if ($validator->fails()) {
            return response()->json([
              'messege' => 'cek your request lah',
            'errors' => $validator->errors()
            ], 422);
        }

        // Update data cassette
        // $cassette->....

        // return cassette yang diupdate sebagai resource
        // return ....
    }

    /**
     * ===========5================
     * Buat fungsi destroy untuk menghapus data cassette
     */
    public function destroy(string $id)
    {
        // Cari data cassette berdasarkan ID
        // $cassette = ....

        if (!$cassette) {
            return response()->json([
               'messege' => 'cek your request lah',
                'errors' => $validator->errors()
            ], 404);
        }

        // Hapus data cassette
        // $cassette->....

        // return message sukses
        // return ....
    }
}
