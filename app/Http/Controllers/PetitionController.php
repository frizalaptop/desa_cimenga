<?php

namespace App\Http\Controllers;

use App\Models\Petition;
use Illuminate\Http\Request;

class PetitionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
        $user = $request->user();

        if (!$user->resident) {
            return back()->with('error', 'Data penduduk tidak ditemukan, silakan lengkapi data diri terlebih dahulu.');
        }
        
        if ($user->role === 'Warga') {
            // Untuk warga, hanya tampilkan pengajuan miliknya saja
            $petitions = Petition::with(['letter', 'resident'])
                ->where('resident_id', $user->resident->id)
                ->latest()
                ->get();
        } else {
            // Untuk sekretaris, tampilkan semua pengajuan dengan filter opsional
            $status = request()->query('status');
            
            $petitions = Petition::with(['letter', 'resident'])
                ->when($status, function($query, $status) {
                    return $query->where('status', $status);
                })
                ->latest()
                ->get();
        }
        
        return view('petitions.index', compact('petitions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(petition $petition)
    {
        if (auth()->user()->role === 'Warga' && $petition->resident_id !== auth()->user()->resident->id) {
            abort(403, 'Anda tidak memiliki akses ke pengajuan ini');
        }
        return view('petitions.show', compact('petition'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(petition $petition)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, petition $petition)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(petition $petition)
    {
        //
    }

    public function approve(Request $request, Petition $petition)
    {
        // Otorisasi - hanya sekretaris yang bisa approve
        if (auth()->user()->role !== 'Sekretaris') {
            abort(403, 'Anda tidak memiliki hak akses untuk menyetujui pengajuan');
        }

        // Validasi status harus pending
        if ($petition->status !== 'pending') {
            return redirect()->back()
                ->with('error', 'Hanya pengajuan dengan status pending yang bisa disetujui');
        }

        try {
            // Update data pengajuan
            $petition->update([
                'status' => 'disetujui',
            ]);

            // Redirect dengan pesan sukses
        return redirect()->route('petitions.show', $petition->id)
            ->with('success', 'Pengajuan surat berhasil disetujui');

    } catch (\Exception $e) {
        // Handle error
        return redirect()->back()
            ->with('error', 'Gagal menyetujui pengajuan: ' . $e->getMessage());
    }
}

    public function reject(Request $request, Petition $petition)
    {
        // Otorisasi - hanya sekretaris yang bisa reject
        if (auth()->user()->role !== 'Sekretaris') {
            abort(403, 'Anda tidak memiliki hak akses untuk menolak pengajuan');
        }

        // Validasi status harus pending
        if ($petition->status !== 'pending') {
            return redirect()->back()
                ->with('error', 'Hanya pengajuan dengan status pending yang bisa ditolak');
        }
        
        try {
            // Update data pengajuan
            $petition->update([
                'status' => 'ditolak',
            ]);


            // Redirect dengan pesan sukses
            return redirect()->route('petitions.show', $petition->id)
                ->with('success', 'Pengajuan surat berhasil ditolak');

        } catch (\Exception $e) {
            // Handle error
            return redirect()->back()
                ->with('error', 'Gagal menolak pengajuan: ' . $e->getMessage());
        }
    }

    public function complete(Request $request, Petition $petition)
    {
        // Otorisasi - hanya sekretaris yang bisa complete
        if (auth()->user()->role !== 'Sekretaris') {
            abort(403, 'Anda tidak memiliki hak akses untuk menyelesaikan pengajuan');
        }

        // Validasi status harus disetujui
        if ($petition->status !== 'disetujui') {
            return redirect()->back()
                ->with('error', 'Hanya pengajuan yang sudah disetujui yang bisa diselesaikan');
        }

        try {
            // Update data pengajuan
            $petition->update([
                'status' => 'selesai',
            ]);

            // Redirect dengan pesan sukses
            return redirect()->route('petitions.show', $petition->id)
                ->with('success', 'Pengajuan surat berhasil diselesaikan');

        } catch (\Exception $e) {
            // Handle error
            return redirect()->back()
                ->with('error', 'Gagal menyelesaikan pengajuan: ' . $e->getMessage());
        }
    }

    public function reset(Request $request)
    {
        // Otorisasi ketat - hanya super admin atau sekretaris utama
        if (auth()->user()->role !== 'Sekretaris') {
            abort(403, 'Anda tidak memiliki hak akses untuk tindakan ini');
        }

        // Validasi konfirmasi
        if (!$request->has('confirmationCheck')) {
            return redirect()->back()
                ->with('error', 'Anda harus mencentang kotak konfirmasi');
        }

        try {
            Petition::truncate();
            return redirect()->route('petitions.index')
                ->with('success', "Berhasil menghapus semua data pengajuan surat");

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}
