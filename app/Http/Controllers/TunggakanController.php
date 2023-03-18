<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;


class TunggakanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function siswaTunggakan()
    {
        //

        $day = Carbon::now()->format('d');
        $parsing = '2022-07-'. $day;
        $toDate = Carbon::parse($parsing);
        $timenow = Carbon::now()->format('Y-m-d');
        $fromDate = Carbon::parse($timenow);
        
        $months = $toDate->diffInMonths($fromDate);

        $nisnSiswa = DB::table('siswa')
        ->leftJoin('pembayaran', 'siswa.nisn', 'pembayaran.nisn')
        ->where('user_id', '=', Auth::id())
        ->where('nominal_bayar', '<', $months * 1000000)
        ->get();

        return view('tunggakan.usertunggakan', compact('nisnSiswa'));
    }

    public function printPdfSingle($id )
    {
        $tunggakan = DB::table('siswa')
        ->where('nisn', '=', $id)
        ->first();

        $pdf = PDF::loadView('tunggakan.cetakpdf', compact('tunggakan'));
        return $pdf->download('tunggakan.pdf');
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
