<?php

namespace App\Http\Controllers;

use App\Models\Spp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SppController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataSpp = DB::table('spp')->get();
        return view('spp.index', compact('dataSpp'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('spp.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $newDataUser = new Spp(); 
        $newDataUser->tahun = $request->tahun;
        $newDataUser->nominal = $request->nominal;
        $newDataUser->save();

        return redirect('spp');

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
        $spp = DB::table('spp')
        ->where('id_spp','=', $id)
        ->first();


        return view('spp.edit', compact('spp'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $newDataUser = Spp::find($id); 
        $newDataUser->tahun = $request->tahun;
        $newDataUser->nominal = $request->nominal;
        $newDataUser->save();

        return redirect('spp');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = Spp::findOrFail($id);
        $delete->delete();

        return redirect('spp');
    }
}
