<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use Carbon\Carbon;
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
        ->orderBy('pembayaran.created_at', 'desc')
        ->get();

        $currentMonth = date('Y');

        $nominalSpp = DB::table('spp')
        ->where('tahun', '=', $currentMonth)
        ->select('tahun','nominal')
        ->first();

        return view('pembayaran.index', compact('dataPembayaran', 'dataSiswa', 'dataPetugas','dataSpp', 'nominalSpp'));
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
        // auto input day,month,year
        $day =  (new Carbon($request->tanggal_bayar))->format("d"); //day
        $month =  (new Carbon($request->tanggal_bayar))->format("m"); //month
        $year =  (new Carbon($request->tanggal_bayar))->format("Y"); //year   
        
        $jumlahSpp = null;
        if(intval($request->metode_pembayaran) === 0 ) {
            $nominalSpp = DB::table('spp')
            ->where('tahun', '=', date('Y'))
            ->select('tahun','nominal')
            ->first();

            $jumlahSpp = $nominalSpp;
        } 
        $idSpp = DB::table('siswa')
        ->where('nisn', '=', $request->id_nisn)
        ->first();

        
        $bayarApaBelumSebelumnya = DB::table('siswa')
        ->where('nisn', '=', $request->id_nisn)
        ->whereNotNull('nominal_bayar')
        ->first();

        if($bayarApaBelumSebelumnya) {

            if(intval($request->metode_pembayaran) === 0 ) {

                DB::table('siswa')
                ->where('nisn', '=', $request->id_nisn)
                ->update([
                    'nominal_bayar' => $jumlahSpp->nominal + $bayarApaBelumSebelumnya->nominal_bayar,
                    'status_bayar' => 1,
                ]);           
                
            } else {
                DB::table('siswa')
                ->where('nisn', '=', $request->id_nisn)
                ->update([
                    'nominal_bayar' => $request->custom_jumlah_bayar + $bayarApaBelumSebelumnya->nominal_bayar,
                    'status_bayar' => 1,
                ]);        
            }
         
        } else {
            if(intval($request->metode_pembayaran) === 0 ) {

                DB::table('siswa')
                ->where('nisn', '=', $request->id_nisn)
                ->update([
                    'nominal_bayar' => $jumlahSpp->nominal,
                    'status_bayar' => 1,
                ]);   
                
            } else {
                DB::table('siswa')
                ->where('nisn', '=', $request->id_nisn)
                ->update([
                    'nominal_bayar' => $request->custom_jumlah_bayar,
                    'status_bayar' => 1,
                    ]);        
            }  
        }

        $newDataUser = new Pembayaran();
        $newDataUser->id_petugas = $request->id_petugas;
        $newDataUser->nisn = $request->id_nisn;
        $newDataUser->tgl_bayar = $day;
        $newDataUser->bulan_dibayar = $month;
        $newDataUser->tahun_dibayar = $year;


        if(intval($request->metode_pembayaran) === 0 ) {
            $newDataUser->jumlah_bayar = $jumlahSpp->nominal;
            $newDataUser->for_month = 1;

        } else {
            $newDataUser->jumlah_bayar = intval($request->custom_jumlah_bayar);
            $newDataUser->for_month = $request->for_month;
        }

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
