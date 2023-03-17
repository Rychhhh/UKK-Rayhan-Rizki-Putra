@extends('dashboard')

@section('content')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <table class="table table-dark align-items-center">
            <thead class="thead-dark">
                <tr>
                <th scope="col">No</th>
                <th scope="col">Nisn</th>
                <th scope="col">Tanggal Bayar</th>
                <th scope="col">Bulan Dibayar</th>
                <th scope="col">Tahun Dibayar</th>
                <th scope="col">Jumlah Bayar</th>
                </tr>
            </thead>
            <tbody class="list">
                @foreach ($history as $item)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <th scope="row">{{ $item->nisn }}</th>
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
@endsection