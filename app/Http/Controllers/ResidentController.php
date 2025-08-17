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
        $resident = Resident::where('user_id', Auth::id())->first();
        return view('residents.index', compact('resident'));
    }

    /**
     * Form tambah data penduduk (hanya kalau belum ada)
     */
    public function create()
    {
        // Cegah jika sudah ada data resident untuk user ini
        if (Resident::where('user_id', Auth::id())->exists()) {
            return redirect()->route('residents.index')
                ->with('error', 'Anda sudah memiliki data penduduk.');
        }

        return view('residents.create');
    }

    /**
     * Simpan data penduduk baru (oleh warga)
     */
    public function store(Request $request)
    {
        // Pastikan user belum punya data penduduk
        if (Resident::where('user_id', Auth::id())->exists()) {
            return redirect()->route('residents.index')
                ->with('error', 'Anda sudah memiliki data penduduk.');
        }

        $request->validate([
            'nik' => 'required|unique:residents,nik',
            'kk' => 'nullable|string|max:16',
            'nama' => 'required|string|max:255',
            'tempat_lahir' => 'nullable|string|max:100',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'nullable|string',
            'rt' => 'nullable|string|max:3',
            'rw' => 'nullable|string|max:3',
            'agama' => 'nullable|string|max:50',
            'status_perkawinan' => 'nullable|string|max:50',
            'pekerjaan' => 'nullable|string|max:100',
            'kewarganegaraan' => 'nullable|string|max:50',
        ]);

        Resident::create([
            ...$request->all(),
            'user_id' => Auth::id(), // otomatis terhubung
        ]);

        return redirect()->route('residents.index')
            ->with('success', 'Data penduduk berhasil ditambahkan.');
    }

    /**
     * Lihat detail penduduk (punya user sendiri)
     */
    public function show()
    {
        $resident = Resident::where('user_id', Auth::id())->firstOrFail();
        return view('residents.show', compact('resident'));
    }

    /**
     * Form edit data penduduk (punya user sendiri)
     */
    public function edit()
    {
        $resident = Resident::where('user_id', Auth::id())->firstOrFail();
        return view('residents.edit', compact('resident'));
    }

    /**
     * Update data penduduk (punya user sendiri)
     */
    public function update(Request $request)
    {
        $resident = Resident::where('user_id', Auth::id())->firstOrFail();

        $request->validate([
            'nik' => 'required|unique:residents,nik,' . $resident->id,
            'kk' => 'nullable|string|max:16',
            'nama' => 'required|string|max:255',
            'tempat_lahir' => 'nullable|string|max:100',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'nullable|string',
            'rt' => 'nullable|string|max:3',
            'rw' => 'nullable|string|max:3',
            'agama' => 'nullable|string|max:50',
            'status_perkawinan' => 'nullable|string|max:50',
            'pekerjaan' => 'nullable|string|max:100',
            'kewarganegaraan' => 'nullable|string|max:50',
        ]);

        $resident->update($request->all());

        return redirect()->route('residents.index')
            ->with('success', 'Data penduduk berhasil diperbarui.');
    }

    /**
     * Hapus data penduduk (punya user sendiri)
     */
    public function destroy()
    {
        $resident = Resident::where('user_id', Auth::id())->firstOrFail();
        $resident->delete();

        return redirect()->route('residents.index')
            ->with('success', 'Data penduduk berhasil dihapus.');
    }
}
