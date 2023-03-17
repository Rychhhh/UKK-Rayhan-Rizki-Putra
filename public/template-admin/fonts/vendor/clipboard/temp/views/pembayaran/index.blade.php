@extends('dashboard')
@section('content')
    <div class="row ">
        <div class="col-sm py-12 text-white  mx-5 sm:px-6 lg:px-7 space-y-6">

            <a href="{{ url('laporan/online_pdf')}}" class="btn btn-sm btn-primary mt-4 mx-4" target="_blank">Online PDF</a>
            <a href="{{ url('laporan/download_pdf')}}" class="btn btn-sm btn-info " target="_blank">Download PDF</a>
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
                    <th scope="col">Handle</th>
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
                            <td class="d-flex">
                                    <form action="{{ url('pembayaran/'.$item->debit_id) }}" method="POST" class="ml-5">
                                    @csrf
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="id" value="{{$item->debit_id}}">
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
        @php
            $years = range(2001, strftime("%Y", time()));
        @endphp

        <div class="text-dark col-sm py-12 text-white w-50 mx-auto sm:px-6 lg:px-8 space-y-6">
            <form action="{{ route('pembayaran.store')}}" method="POST">
                @csrf
                <input type="hidden" name="_method" value="POST">
                <input type="hidden" name="id">

                <div class="d-flex flex-col my-3">
                  <label for="exampleInputEmail1" class="form-control-label">Petugas</label>
                  <select class="form-control" aria-label="Default select example" name="id_petugas">
                    @foreach ($dataPetugas as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                  </select>
                <small id="emailHelp" class="form-text text-white">Pilih Petugas.</small>
                </div>
                <div class="d-flex flex-col my-3">
                  <label for="exampleInputPassword1" class="form-control-label">Nisn</label>
                  <select class="form-control" aria-label="Default select example" name="id_nisn">
                    @foreach ($dataSiswa as $item)
                        <option value="{{ $item->nisn }}">{{ $item->nisn }}  Nama : {{ $item->nama}}</option>
                    @endforeach
                  </select>
                <small id="emailHelp" class="form-text text-white">Pilih Nisn Dan Siswa Dan SPP.</small>
                </div>
                <div class="d-flex flex-col my-3">
                  <label for="exampleInputPassword1" class="form-control-label">Tanggal Bayar</label>
                  <input type="date" class="form-control" name="tanggal_bayar" placeholder="Password">
                </div>
                <div class="mb-3 my-3">
                    <label for="exampleInputEmail1" class="form-control-label"> Tahun Dibayar</label>
                    <select class="form-control" name="tahun_bayar">
                        <option>Select Year</option>
                        @foreach($years as $year) : ?>
                          <option value="@php echo $year; @endphp">@php echo $year; @endphp</option>
                        @endforeach
                      </select>
                </div>
                <div class="d-flex flex-col my-3">
                  <label for="exampleInputPassword1" class="form-control-label">Bulan Dibayar</label>
                  <input type="month" class="form-control" name="bulan_bayar" placeholder="Password">
                </div>
                <div class="d-flex flex-col my-3">
                    <label for="exampleInputPassword1" class="form-control-label">Jumlah Bayar</label>
                    <input type="number" class="form-control" name="jumlah_bayar" placeholder="Jumlah Bayar">
                  </div>
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
        </div>
    </div>
  </div>
@endsection