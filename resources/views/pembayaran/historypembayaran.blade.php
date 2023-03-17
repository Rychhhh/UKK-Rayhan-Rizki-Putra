@extends('layouts.temp')

@section('breadcrumb')
<div class="row">
    <div class="card card-stats">
        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
            <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Dashboards</a></li>
            <li class="breadcrumb-item active" aria-current="page">Histori Pembayaran</li>
          </ol>
        </div>
    </div>
  </div>
@endsection

@section('content')
<div class="row ">
    <div class="col-sm py-12 text-white  mx-5 sm:px-6 lg:px-7 space-y-6">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <table class="table table-dark align-items-center">
            <thead class="text-center thead-dark">
                <tr>
                <th scope="col">No</th>
                <th scope="col">Nisn</th>
                <th scope="col">Nis</th>
                <th scope="col">Name</th>
                <th scope="col">Tanggal Bayar</th>
                <th scope="col">Bulan Bayar</th>
                <th scope="col">Tahun Bayar</th>
                <th scope="col">Jumlah Bayar</th>
                </tr>
            </thead>
            <tbody class="list">
                @foreach ($dataPembayaran as $item)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{$item->nisn}}</td>
                        <td>{{$item->nis}}</td>
                        <td>{{$item->nama}}</td>
                        <td>{{$item->tgl_bayar}}</td>
                        <td>{{$item->bulan_dibayar}}</td>
                        <td>{{$item->tahun_dibayar}}</td>
                        <td>Rp. {{number_format($item->jumlah_bayar, 2, ',', '.')}}</td>
                    </tr>
                @endforeach
            </tbody>
            </table>
        </div>
    </div>
</div>
</div>
@endsection