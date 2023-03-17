@extends('layouts.temp')

@section('breadcrumb')
<div class="row">
  <div class="card card-stats">
      <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
          <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
          <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Dashboards</a></li>
          <li class="breadcrumb-item active" aria-current="page">Tambah Spp</li>
        </ol>
      </div>
  </div>
</div>
@endsection

@section('content')
    <div class="py-12">
        <div class="text-white max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <form action="{{ route('spp.store')}}" method="POST">
                @csrf
                <input type="hidden" name="_method" value="POST">
                <input type="hidden" name="id_spp">

                @php
                     $years = range(2001, strftime("%Y", time()));

                @endphp

                <div class="mb-3 ">
                    <label for="exampleInputEmail1" class="form-label text-dark">Tahun</label>
                    <select class="bg-gray-500 form-control" name="tahun">
                        <option>Select Year</option>
                        @foreach($years as $year) : ?>
                          <option value="@php echo $year; @endphp">@php echo $year; @endphp</option>
                        @endforeach
                      </select>
                </div>

                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label text-dark">Nominal</label>
                  <input type="number" name="nominal" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                  <b>Enter Your Nominal</b>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
        </div>
    </div>
  </div>
@endsection

