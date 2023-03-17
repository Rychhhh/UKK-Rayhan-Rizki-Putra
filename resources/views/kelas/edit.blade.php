@extends('layouts.temp')

@section('breadcrumb')
<div class="row">
    <div class="card card-stats">
        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
            <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Dashboards</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Kelas</li>
          </ol>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="py-12">
    <div class=" max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <form action="{{ url('kelas/'. $kelas->id_kelas)}}" method="POST">
            @csrf
            <input type="hidden" name="_method" value="PATCH">
            <input type="hidden" name="id" value="{{ $kelas->id_kelas }}">

            <div class="mb-3 form-group">
              <label for="exampleInputEmail1" class="form-control-label">Nama Kelas</label>
              <input type="text" name="namakelas" value="{{ $kelas->nama_kelas }}" class="form-control " id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3 form-group">
              <label for="exampleInputEmail1" class="form-control-label">Kompetensi Keahlian</label>
              <input type="text" name="kompetensikeahlian" value="{{ $kelas->kompetensi_keahlian }}" class="form-control bg-gray-80" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
    </div>
</div>
</div>
@endsection