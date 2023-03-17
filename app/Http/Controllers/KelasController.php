<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $getData = DB::table('kelas')
        ->get();
        return view('kelas.index', compact('getData'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('kelas.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $newDataUser = new Kelas(); 
        $newDataUser->nama_kelas = $request->nama_kelas;
        $newDataUser->kompetensi_keahlian = $request->kompetensi_keahlian;
        $newDataUser->save();

        return redirect('kelas');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $kelas = DB::table('kelas')
        ->where('id_kelas', '=', $id)
        ->first();

        return view('kelas.edit', compact('kelas'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $newDataUser = Kelas::find($id); 
        $newDataUser->nama_kelas = $request->namakelas;
        $newDataUser->kompetensi_keahlian = $request->kompetensikeahlian;
        $newDataUser->save();

        return redirect('kelas');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $destroy = Kelas::findOrFail($id);
        $destroy->delete();

        return redirect('kelas');
    }
}
