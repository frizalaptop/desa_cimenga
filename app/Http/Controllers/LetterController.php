<?php

namespace App\Http\Controllers;

use App\Models\letter;
use App\Models\Petition;
use App\Models\Resident;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;


class LetterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $letters = Letter::all();
        return view('letters.index', compact('letters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('letters.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_surat'    => 'required|string|max:255',
            'kode_surat'    => 'required|string|max:50|unique:letters,kode_surat',
            'template_file' => 'nullable|file|mimes:doc,docx|max:2048',
        ]);

        // Simpan file template jika ada
        $filePath = null;
        if ($request->hasFile('template_file')) {
            $filePath = $request->file('template_file')
                        ->store('templates', 'public'); // simpan di storage/app/public/templates
        }

        // Simpan ke DB
        Letter::create([
            'nama_surat'    => $validated['nama_surat'],
            'kode_surat'    => $validated['kode_surat'],
            'template_file' => $filePath,
        ]);

        return redirect()->route('letters.index')
            ->with('success', 'Surat berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(letter $letter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(letter $letter)
    {
        return view('letters.edit', compact('letter'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, letter $letter)
    {
        $request->validate([
            'nama_surat' => 'required|string|max:255',
            'kode_surat' => 'required|string|max:50|unique:letters,kode_surat,'.$letter->id,
            'template_file' => 'nullable|file|mimes:doc,docx|max:2048'
        ]);

        $letter->nama_surat = $request->nama_surat;
        $letter->kode_surat = $request->kode_surat;

        if ($request->hasFile('template_file')) {
            // Hapus file lama jika ada
            if ($letter->template_file) {
                Storage::disk('public')->delete($letter->template_file);
            }
            
            // Simpan file baru
            $path = $request->file('template_file')->store('templates', 'public');;
            $letter->template_file = $path;
        }

        $letter->save();

        return redirect()->route('letters.index')
            ->with('success', 'Surat berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Letter $letter)
    {
        if ($letter->template_file) {
            Storage::disk('public')->delete($letter->template_file);
        }
        
        $letter->delete();
        
        return redirect()->route('letters.index')->with('success', 'Surat berhasil dihapus');
    }

    public function apply(Request $request, Letter $letter)
    {
        // Ambil resident yang terkait dengan user login
        $resident = Resident::where('user_id', Auth::id())->first();

        if (!$resident) {
            return back()->withErrors('Data penduduk tidak ditemukan, silakan lengkapi data diri terlebih dahulu.');
        }

        if (!$letter->template_file) {
            return back()->withErrors('Layanan belum tersedia.');
        }

        // Simpan pengajuan
        $petition = Petition::create([
            'resident_id' => $resident->id,
            'letter_id'   => $letter->id,
            'keperluan'   => $letter->nama_surat,
            'status'      => 'pending', // default
            'file_pdf' => $letter->template_file,
        ]);

        return redirect()
            ->route('letters.index')
            ->with('success', 'Pengajuan surat berhasil dikirim. Menunggu persetujuan.');
    }
}