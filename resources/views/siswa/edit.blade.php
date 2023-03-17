@extends('layouts.temp')

@section('breadcrumb')
<div class="row">
    <div class="card card-stats">
        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
            <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Dashboards</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Siswa</li>
          </ol>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="py-12">
    <div class=" max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <form action="{{ url('siswa/'. $siswa->nisn)}}" method="POST">
            @csrf
            <input type="hidden" name="_method" value="PATCH">

            <div class="mb-3 d-flex flex-col">
              <label for="exampleInputEmail1" class="form-control-label">Nisn</label>
              <input type="number" name="nisn" 
              oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
              maxlength="10" class="form-control" id="exampleInputEmail1" aria-describedby="nisn" value="{{ $siswa->nisn}}">
              <b class="form-control-label">Enter Your Nisn</b>
            </div>

            <div class="mb-3 d-flex flex-col">
              <label for="exampleInputEmail1" class="form-control-label">Nis</label>
              <input type="number" name="nis"
              oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
              maxlength="8" class="form-control" id="exampleInputEmail1" aria-describedby="nis" value="{{ $siswa->nis}}">
              <b class="form-control-label">Enter Your Nis</b>
            </div>

            <div class="mb-3 d-flex flex-col">
              <label for="exampleInputEmail1" class="form-control-label">Name</label>
              <input type="text" name="name" class="form-control1" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $siswa->nama}}">
              <b class="form-control-label">Enter Your Name</b>
            </div>

            <div class="mb-3 d-flex flex-col">
                <label for="exampleInputEmail1" class="form-control-label">Kelas</label>
                <select class="form-control  form-select" name="kelas" aria-label="Default select example">
                    @foreach($dataListKelas as $year) : ?>
                      <option value="{{ $year->id_kelas }}">{{ $year->nama_kelas}}</option>
                    @endforeach
                  </select>
            </div>

            <div class="mb-3 d-flex flex-col">
              <label for="exampleInputEmail1" class="form-control-label">Alamat</label>
              <textarea name="alamat" class="form-control" id="" cols="30" rows="10">{{ $siswa->alamat}}</textarea>
              <b class="form-control-label">Enter Your Alamat</b>
            </div>

            <div class="mb-3 d-flex flex-col">
              <label for="exampleInputEmail1" class="form-control-label">No Telepon</label>
              <input type="number" name="no_telp" class=" form-control" value="{{ $siswa->no_telp }}" id="exampleInputEmail1" aria-describedby="emailHelp">
              <b class="form-control-label">Enter Your No Telepon</b>
            </div>

            <div class="mb-3 d-flex flex-col">
                <label for="exampleInputEmail1" class="form-control-label">Tahun SPP</label>
                <select class="form-control form-select" name="spp" aria-label="Default select example">
                    @foreach($dataListSpp as $data)
                      <option value="{{ $data->id_spp }}">Tahun SPP: {{ $data->tahun}} Nominal SPP: {{ $data->nominal}}</option>
                    @endforeach
                  </select>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
    </div>
</div>
</div>
@endsection