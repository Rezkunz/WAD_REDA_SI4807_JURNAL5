<?php

namespace App\Http\Controllers;

use App\Models\Vhs;
use App\Http\Resources\VhsResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VhsController extends Controller
{
    /**
     * ===========1================
     * Buat fungsi index yang mengembalikan semua data vhs
     */
    public function index()
    {
        // ambil semua data vhs
        // $vhss = ....
        $vhss = Vhs::all();
        // return koleksi vhs
        // return ....
        return VhsResource::collection($vhss);
    }

    /**
     * ===========2================
     * Buat fungsi store untuk menambahkan data vhs baru
     */
    public function store(Request $request)
    {
        // Request body berisi title, director dan year
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'director' => 'required|string|max:255',
            'year' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                // 'success' => false,
                'success' => 'false',
                'message' => 'Please check your request',
                // 'errors' => ....
                'errors' => $validator->errors()
            ], 422);
        }

        // Buat data vhs
        // $vhs = ....
        $vhs = Vhs::create($validator->validated());
        // return vhs yang dibuat sebagai resource
        // return ....
        return (new VhsResource($vhs))
                ->additional(['messages' => 'Vhs Created Successfully'])
                ->response()
                ->setStatusCode(201);
    }

    /**
     * ===========3================
     * Buat fungsi show untuk menampilkan satu data vhs berdasarkan ID
     */
    public function show(string $id)
    {
        // Cari data vhs berdasarkan ID
        // $vhs = ....
        $vhs = Vhs::find($id);

        if (!$vhs) {
            return response()->json([
                // 'success' => false,
                'success' => 'false',
                // 'message' => ....
                'messages'=>'Vhs Not Found'
            ], 404);
        }

        // return vhs sebagai resource
        // return ....
        return new VhsResource($vhs);
    }

    /**
     * ===========4================
     * Buat fungsi update untuk mengubah data vhs yang ada
     */
    public function update(Request $request, string $id)
    {
        // Request body berisi title, director dan year
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'director' => 'required|string|max:255',
            'year' => 'required|integer',
        ]);

        // Cari data vhs berdasarkan ID
        // $vhs = ....
        $vhs = Vhs::findOrFail($id);
        if (!$vhs) {
            return response()->json([
                // 'success' => false,
                'success' => 'false',
                // 'message' => ....
                'messages' => 'Vhs Not Found'
            ], 404);
        }


        if ($validator->fails()) {
            return response()->json([
                // 'success' => false,
                'success' => 'false',
                'messages' => 'Please Check Your Request',
                // 'errors' => ....
                'errors' => $validator->errors()
            ], 422);
        }

        // Update data vhs
        // $vhs->....
        $vhs->update($validator->validated());
        // return vhs yang diupdate sebagai resource
        // return ....
        return (new VhsResource($vhs))
                ->additional(['messages'=>'Vhs Update Successfully'])
                ->response()
                ->setStatusCode(200);
    }

    /**
     * ===========5================
     * Buat fungsi destroy untuk menghapus data vhs
     */
    public function destroy(string $id)
    {
        // Cari data vhs berdasarkan ID
        // $vhs = ....
        $vhs = Vhs::findOrFail($id);
        if (!$vhs) {
            return response()->json([
                // 'success' => false,
                'success' => 'false',
                // 'message' => ....
                'messages' => 'Vhs Not Found'
            ], 404);
        }

        // Hapus data vhs
        // $vhs->....
        $vhs->delete();
        // return message sukses
        // return ....
        return response()->json(['messages' => 'Vhs Delete Successfully'], 200);
    }
}
