<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $dataSiswa = DB::table('siswa')
        ->leftJoin('kelas', 'siswa.id_kelas', 'kelas.id_kelas')
        ->leftJoin('spp', 'siswa.id_spp', 'spp.id_spp')
        ->leftJoin('pembayaran', 'siswa.nisn',  'pembayaran.nisn')
        ->select('*', 'kelas.nama_kelas', 'spp.tahun as tahun_spp', 'spp.nominal as nominal_spp', 'pembayaran.for_month')
        ->get();


        $dataListKelas = DB::table('kelas')
        ->get();

        return view('siswa.index', compact('dataSiswa', 'dataListKelas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $dataListKelas = DB::table('kelas')
        ->get();
        $dataListSpp = DB::table('spp')
        ->get();

        return view('siswa.add', compact('dataListKelas', 'dataListSpp'));
    }

    public function filterStatusPembayaran(Request $request)
    {
        $filter = $request->filter_status;

        $day = Carbon::now()->format('d');
        $parsing = '2022-07-'. $day;
        $toDate = Carbon::parse($parsing);
        $timenow = Carbon::now()->format('Y-m-d');
        $fromDate = Carbon::parse($timenow);
        $months = $toDate->diffInMonths($fromDate);

        if($filter === 'sudah') {
            $dataSiswa = DB::table('siswa')
            ->leftJoin('kelas', 'siswa.id_kelas', 'kelas.id_kelas')
            ->leftJoin('spp', 'siswa.id_spp', 'spp.id_spp')
            ->leftJoin('pembayaran', 'siswa.nisn', 'pembayaran.nisn')
            ->select('*', 'kelas.nama_kelas', 'spp.tahun as tahun_spp', 'spp.nominal as nominal_spp', 'pembayaran.for_month')
            ->where('nominal_bayar', '>=', $months * 1000000)
            ->where('siswa.id_kelas', '=', $request->kelas)
            ->get();

            $dataListKelas = DB::table('kelas')
            ->get();
    

            return view('siswa.index', compact('dataSiswa', 'dataListKelas'));
        }

        if($filter === 'nunggak') {
            $dataSiswa = DB::table('siswa')
            ->leftJoin('kelas', 'siswa.id_kelas', 'kelas.id_kelas')
            ->leftJoin('spp', 'siswa.id_spp', 'spp.id_spp')
            ->leftJoin('pembayaran', 'siswa.nisn', 'pembayaran.nisn')
            ->select('*', 'kelas.nama_kelas', 'spp.tahun as tahun_spp', 'spp.nominal as nominal_spp', 'pembayaran.for_month')
            ->where('nominal_bayar', '<', $months * 1000000)
            ->where('siswa.id_kelas', '=', $request->kelas)
            ->get();

            $dataListKelas = DB::table('kelas')
            ->get();
    

            return view('siswa.index', compact('dataSiswa', 'dataListKelas'));
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $insertSiswaGetId = DB::table('users')
        ->insertGetId([
            'name' => $request->name,
            'email' => $request->name. '@gmail.com',
            'password' => Hash::make($request->name),
            'role' => 'siswa',
        ]);

        $newDataUser = new Siswa();
        $newDataUser->nisn = $request->nisn;
        $newDataUser->nis = $request->nis;
        $newDataUser->nama = $request->name;
        $newDataUser->id_kelas = $request->kelas;
        $newDataUser->alamat = $request->alamat;
        $newDataUser->no_telp = $request->no_telp;
        $newDataUser->id_spp = $request->spp;
        $newDataUser->user_id = $insertSiswaGetId;
        $newDataUser->save();

        if(!$newDataUser->getOriginal()) {
            return redirect('siswa')->with('failed', 'Data Gagal Ditambahkan !');
        } 
        
        if($newDataUser->getOriginal()) {
            return redirect('siswa')->with('success', 'Berhasil Ditambahkan!');
        }

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
    public function edit($id)
    {
        $siswa = DB::table('siswa')
        ->where('nisn', '=', $id)
        ->first();

        $dataListKelas = DB::table('kelas')
        ->get();
        $dataListSpp = DB::table('spp')
        ->get();

        return view('siswa.edit', compact('siswa', 'dataListKelas', 'dataListSpp'));    
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $newDataUser = Siswa::find($id);
        $newDataUser->nisn = $request->nisn;
        $newDataUser->nis = $request->nis;
        $newDataUser->nama = $request->name;
        $newDataUser->id_kelas = $request->kelas;
        $newDataUser->alamat = $request->alamat;
        $newDataUser->no_telp = $request->no_telp;
        $newDataUser->id_spp = $request->spp;
        $newDataUser->save();

        return redirect('siswa');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = Siswa::findOrFail($id);
        $deleteDataUsers = DB::table('users')
        ->where('id', '=', $delete->user_id)
        ->delete();
        $delete->delete();

        if($deleteDataUsers) {
            return redirect('siswa')->with('success', 'Data Berhasil Dihapus');
        }

    }
}
