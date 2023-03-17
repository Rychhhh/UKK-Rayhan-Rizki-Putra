@extends('dashboard')

@section('content')
    <div class="py-12">
        <div class="text-white max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <form action="{{ route('spp.store')}}" method="POST">
                @csrf
                <input type="hidden" name="_method" value="POST">
                <input type="hidden" name="id">

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

                <div class="d-flex flex-col my-3">
                  <label for="exampleInputPassword1" class="form-control-label">Bulan Ke</label>
                  <input type="number" class="form-control" name="bulan">
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

