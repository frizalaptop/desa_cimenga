<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResidentController extends Controller
{
    /**
     * Menampilkan data penduduk milik user yang login
     */
    public function index()
    {
        
    }

    /**
     * Form tambah data penduduk (hanya kalau belum ada)
     */
    public function create()
    {
        
    }

    /**
     * Simpan data penduduk baru (oleh warga)
     */
    public function store(Request $request)
    {
        $resident = Resident::where('user_id', Auth::id())->first();

        $rules = [
            'nik' => 'required|numeric|digits:16|unique:residents,nik,'.($resident ? $resident->id : 'NULL').',id,user_id,'.Auth::id(),
            'kk' => 'nullable|numeric|digits:16',
            'nama' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date|before:today',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required|string',
            'rt' => 'required|numeric|',
            'rw' => 'required|numeric|',
            'agama' => 'required|string|max:50',
            'status_perkawinan' => 'required|string|max:50',
            'pekerjaan' => 'required|string|max:100',
            'kewarganegaraan' => 'required|string|max:50',
        ];

        $validated = $request->validate($rules);

        if ($resident) {
            // Update data yang sudah ada
            $resident->update($validated);
            $message = 'Data penduduk berhasil diperbarui';
        } else {
            // Buat data baru
            $validated['user_id'] = Auth::id();
            Resident::create($validated);
            $message = 'Data penduduk berhasil disimpan';
        }

        return redirect()->route('residents.show', Auth::user()->id)->with('success', $message);
    }

    /**
     * Lihat detail penduduk (punya user sendiri)
     */
    public function show()
    {
        $resident = Resident::where('user_id', Auth::id())->first();
        return view('residents.form', compact('resident'));
    }

    /**
     * Form edit data penduduk (punya user sendiri)
     */
    public function edit()
    {
        
    }

    /**
     * Update data penduduk (punya user sendiri)
     */
    public function update(Request $request)
    {
        
    }

    /**
     * Hapus data penduduk (punya user sendiri)
     */
    public function destroy()
    {
        
    }
}
