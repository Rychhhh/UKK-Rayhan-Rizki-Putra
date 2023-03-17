@extends('dashboard')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <table class="table align-items-center table-dark">
            <thead class="thead-dark text-center">
                <tr>
                <th scope="col">No</th>
                <th scope="col">Nisn</th>
                <th scope="col">Telah Dibayar</th>
                <th scope="col">Sisa Bulan</th>
                <th scope="col">Total Tunggakan</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody class="list text-center">
                @foreach ($nisnSiswa as $item)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{$item->nisn}}</td>
                        <td>Rp. {{ number_format($item->nominal_bayar, 2, ',', '.')}}</td>
                        <td>{{ date('m') * 1000000 / 1000000 -  $item->nominal_bayar / 1000000}} Bulan</td>

                        <td>Rp. {{ number_format(date('m') * 1000000 - $item->nominal_bayar,  2, ',', '.') }}</td>
                        <td>
                            <a  class="btn btn-sm btn-primary">Bayar</a>
                            <a href="{{ url('print-pdf-single/'. $item->nisn)}}" class="btn btn-sm btn-success">Print</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            </table>
        </div>
    </div>
  </div>
@endsection