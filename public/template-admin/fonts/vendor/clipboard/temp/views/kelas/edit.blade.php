    @extends('dashboard')

    @section('content')
    <div class="py-12">
        <div class=" max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <form action="{{ url('kelas/'. $kelas->id)}}" method="POST">
                @csrf
                <input type="hidden" name="_method" value="PATCH">
                <input type="hidden" name="id" value="{{ $kelas->id }}">

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
