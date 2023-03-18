@extends('layouts.temp')

@section('breadcrumb')
<div class="row">
    <div class="card card-stats">
        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
            <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Dashboards</a></li>
            <li class="breadcrumb-item active" aria-current="page">Siswa</li>
          </ol>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="py-12" style="overflow-x : scroll">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
    <a href="{{ route('siswa.create')}}" class="btn btn-sm btn-success">
        Add
    </a>

    @if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
    @endif

    @if(session()->has('failed'))
        <div class="alert alert-danger">
            {{ session()->get('failed') }}
        </div>
    @endif
    
    <table  class="table align-items-center table-dark">

        <thead class="thead-dark">
            <tr>
            <th scope="col">Nisn</th>
            <th scope="col">Nis</th>
            <th scope="col">Nama</th>
            <th scope="col">Kelas</th>
            <th scope="col">Alamat</th>
            <th scope="col">No Telp</th>
            <th scope="col">Tahun SPP</th>
            <th scope="col">Nominal SPP Per Bulan</th>
            <th scope="col">Nominal Sudah Bayar</th>
            <th scope="col">Status Dibayar</th>
            <th scope="col">Handle</th>
            </tr>
        </thead>
        <tbody class="list">
            @foreach ($dataSiswa as $item)
                <tr>
                    <th scope="row">{{ $item->nisn }}</th>
                    <td>{{$item->nis}}</td>
                    <td>{{$item->nama}}</td>
                    <td>{{$item->nama_kelas}}</td>
                    <td>{{$item->alamat}}</td>
                    <td>{{$item->no_telp}}</td>
                    <td>{{$item->tahun_spp}}</td>
                    <td>Rp. {{number_format($item->nominal_spp, 2, ',', '.')}}</td>
                    <td>Rp. {{number_format($item->nominal_bayar, 2, ',', '.')}}</td>
                    @if ($item->status_bayar === 0)
                      @if ($item->nominal_bayar === null)
                        <td>
                          <div class="btn btn-sm btn-danger">Belum Dibayar</div>
                        </td>
                      @endif
                    @else
                      @if ($item->nominal_bayar >= date('m') * 1000000)
                        <td>
                          <div class="btn btn-sm btn-success">Dibayar</div>
                        </td>
                      @else
                        <td>
                          <div class="btn btn-sm btn-danger">Nunggak</div>
                        </td>
                      @endif
                    @endif
                    <td class="d-flex">
                          <a class="mt-1 btn btn-sm btn-success" href="{{ url('siswa/'. $item->nisn. '/edit')}}">
                            Edit
                          </a>
                            <form action="{{ url('siswa/'.$item->nisn) }}" method="POST" class="ml-5">
                            @csrf
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="nisn" value="{{$item->nisn}}">
                            <button type="submit" class="btn btn-danger btn-sm ms-3 mt-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                              Delete
                            </button>
                          </form>

                    </td>
                </tr>
            @endforeach
        </tbody>
        </table>
    </div>
</div>
</div>
@endsection