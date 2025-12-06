<?php

namespace App\Http\Controllers;

use App\Models\DvdAudio;
use App\Http\Resources\DvdaudioResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DvdaudioController extends Controller
{
    /**
     * ===========1================
     * Buat fungsi index yang mengembalikan semua data dvdaudio
     */
    public function index()
    {
        // ambil semua data dvdaudio
        // $dvdaudios = ....
        $dvdaudios = Dvdaudio::all();
        // return koleksi dvdaudio
        // return ....
        return DvdaudioResource::collection($dvdaudios);
    }

    /**
     * ===========2================
     * Buat fungsi store untuk menambahkan data dvdaudio baru
     */
    public function store(Request $request)
    {
        // Request body berisi title, artist dan year
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'artist' => 'required|string',
            'year' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                // 'success' => false,
                'success' => false,
                // 'errors' => ....
                'errors' => $validator->errors()
            ], 422);
        }

        // Buat data dvdaudio
        // $dvdaudio = ....
        $dvdaudio = Dvdaudio::create($validator->validated());
        // return dvdaudio yang dibuat sebagai resource
        // return ....
        return (new DvdaudioResource($dvdaudio))
                    ->additional(['message' => 'Created successfully'])
                    ->response()
                    ->setStatusCode(201);

    }

    /**
     * ===========3================
     * Buat fungsi show untuk menampilkan satu data dvdaudio berdasarkan ID
     */
    public function show(string $id)
    {
        // Cari data dvdaudio berdasarkan ID
        // $dvdaudio = ....
        $dvdaudio = Dvdaudio::find($id);
        if (!$dvdaudio) {
            return response()->json([
                // 'success' => false,
                'sucess' => false,
                // 'message' => ....
                'message' => 'Not Found'
            ], 404);
        }

        // return dvdaudio sebagai resource
        // return ....
        return new DvdaudioResource($dvdaudio);
    }

    /**
     * ===========4================
     * Buat fungsi update untuk mengubah data dvdaudio yang ada
     */
    public function update(Request $request, string $id)
    {
        // Request body berisi title, artist dan year
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'artist' => 'string',
            'year' => 'integer',
        ]);

        // Cari data dvdaudio berdasarkan ID
        // $dvdaudio = ....
        $dvdaudio = Dvdaudio::find($id);

        if (!$dvdaudio) {
            return response()->json([
                // 'success' => false,
                'success' => false,
                // 'message' => ....
                'message' => 'Not Found'
            ], 404);
        }


        if ($validator->fails()) {
            return response()->json([
                // 'success' => false,
                'succes' => false,
                // 'errors' => ....
                'errors' => $validator->errors()
            ], 422);
        }

        // Update data dvdaudio
        // $dvdaudio->....
        $dvdaudio->update($validator->validated());
        // return dvdaudio yang diupdate sebagai resource
        // return ....
        return (new DvdaudioResource($dvdaudio))
                    ->additional(['message' => 'Updated successfully'])
                    ->response()
                    ->setStatusCode(200);
    }

    /**
     * ===========5================
     * Buat fungsi destroy untuk menghapus data dvdaudio
     */
    public function destroy(string $id)
    {
        // Cari data dvdaudio berdasarkan ID
        // $dvdaudio = ....
        $dvdaudio = Dvdaudio::find($id);

        if (!$dvdaudio) {
            return response()->json([
                // 'success' => false,
                'success' => false,
                // 'message' => ....
                'message' => 'Not Found'
            ], 404);
        }

        // Hapus data dvdaudio
        // $dvdaudio->....
        $dvdaudio->delete();
        // return message sukses
        // return ....
        return response()->json(['message' => 'Deleted successfully'], 200);
    }
}
