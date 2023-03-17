@extends('dashboard')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <a href="{{ route('spp.create')}}" class="btn btn-danger btn-neutral">
            Add
        </a>
        <table class="table align-items-center table-dark">
            <thead class="thead-dark">
                <tr>
                <th scope="col">No</th>
                <th scope="col">Bulan </th>
                <th scope="col">Tahun</th>
                <th scope="col">Nominal</th>
                <th scope="col">Handle</th>
                </tr>
            </thead>
            <tbody class="list">
                @foreach ($dataSpp as $item)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{$item->bulan}} Bulan</td>
                        <td>{{$item->tahun}}</td>
                        <td> Rp. {{ number_format($item->nominal, 2, ',', '.')}}</td>
                        <td class="d-flex">
                              <a class="mt-1 btn btn-sm btn-success" href="{{ url('spp/'. $item->id. '/edit')}}">
                                Edit
                              </a>
                                <form action="{{ url('spp/'.$item->id) }}" method="POST" class="ml-5">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="id" value="{{$item->id}}">
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