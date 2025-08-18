<?php

namespace App\Http\Controllers;

use App\Models\petition;
use Illuminate\Http\Request;

class PetitionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
        $user = $request->user();
        
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
        //
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
}
