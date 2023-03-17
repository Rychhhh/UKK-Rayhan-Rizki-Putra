@extends('dashboard')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <form action="{{ route('kelas.store')}}" method="POST">
                @csrf
                <input type="hidden" name="_method" value="POST">
                <input type="hidden" name="id_kelas">

                <div class="mb-3 form-group">
                  <label for="exampleInputEmail1" class="form-control-label">Nama Kelas</label>
                  <input type="text" name="nama_kelas" class="form-control">
                </div>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-control-label">Kompetensi Keahlian</label>
                  <input type="text" name="kompetensi_keahlian" class="form-control bg-gray-80">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
        </div>
    </div>
  </div>
@endsection