<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $dataSiswa = DB::table('siswa')
        ->get();
        //
        $dataPetugas = DB::table('users')
        ->where('role', '=', 'petugas')
        ->get();

        $dataSpp = DB::table('spp')
        ->get();

        $dataPembayaran = DB::table('pembayaran')
        ->leftJoin('spp', 'pembayaran.id_spp',  '=', 'spp.id_spp')
        ->leftJoin('siswa', 'pembayaran.nisn','=', 'siswa.nisn')
        ->select('*', 'pembayaran.id as debit_id')
        ->get();

        return view('pembayaran.index', compact('dataPembayaran', 'dataSiswa', 'dataPetugas','dataSpp'));
    }

    public function historyPembayaranPetugas(Request $request)
    {
        $dataPembayaran = DB::table('pembayaran')
        ->leftJoin('spp', 'pembayaran.id_spp',  '=', 'spp.id_spp')
        ->leftJoin('siswa', 'pembayaran.nisn','=', 'siswa.nisn')
        ->select('*', 'pembayaran.id as debit_id')
        ->get();

        return view('pembayaran.historypembayaran', compact('dataPembayaran'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function history(Request $request)
    {
        $getNisn = DB::table('siswa')
        ->where('user_id', '=', Auth::user()->id)
        ->first();
                
        $dataPembayaran = DB::table('pembayaran')
        ->leftJoin('spp', 'pembayaran.id_spp',  '=', 'spp.id_spp')
        ->leftJoin('siswa', 'pembayaran.nisn','=', 'siswa.nisn')
        ->select('*', 'pembayaran.id as debit_id')
        ->where('pembayaran.nisn', '=', $getNisn->nisn)
        ->get();

        return view('siswa.history_siswa_pembayaran', compact('dataPembayaran'));
    }

    public function laporanPdfOnline()
    {
        $pembayaran = DB::table('pembayaran')->get();

        $pdf = PDF::loadView('pembayaran.cetakpdf', compact('pembayaran'));
        return $pdf->stream();
    }

    public function laporanPdfDownload()
    {
        $pembayaran = DB::table('pembayaran')->get();

        $pdf = PDF::loadView('pembayaran.cetakpdf', compact('pembayaran'));
        return $pdf->download('pembayaran.pdf');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $idSpp = DB::table('siswa')
        ->where('nisn', '=', $request->id_nisn)
        ->first();

        
        $bayarApaBelumSebelumnya = DB::table('siswa')
        ->where('nisn', '=', $request->id_nisn)
        ->whereNotNull('nominal_bayar')
        ->first();

        if($bayarApaBelumSebelumnya) {
             DB::table('siswa')
            ->where('nisn', '=', $request->id_nisn)
            ->update([
                'nominal_bayar' => $request->jumlah_bayar + $bayarApaBelumSebelumnya->nominal_bayar,
                'status_bayar' => 1
            ]);           
        } else {
            DB::table('siswa')
            ->where('nisn', '=', $request->id_nisn)
            ->update([
                'nominal_bayar' => $request->jumlah_bayar,
                'status_bayar' => 1
            ]);            

        }

        $newDataUser = new Pembayaran();
        $newDataUser->id_petugas = $request->id_petugas;
        $newDataUser->nisn = $request->id_nisn;
        $newDataUser->tgl_bayar = $request->tanggal_bayar;
        $newDataUser->bulan_dibayar = $request->bulan_bayar;
        $newDataUser->tahun_dibayar = $request->tahun_bayar;
        $newDataUser->jumlah_bayar = $request->jumlah_bayar;
        $newDataUser->id_spp = $idSpp->id_spp;
        $newDataUser->save();

        return redirect('pembayaran');
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
    public function destroy( $id)
    {
        //
        $delete = Pembayaran::findOrFail($id);
        $delete->delete();

        return redirect('pembayaran');
    }
}
