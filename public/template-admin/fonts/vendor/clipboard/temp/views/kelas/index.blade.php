@extends('dashboard')

@section('content')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <a href="{{ route('kelas.create')}}" class="btn btn-success btn-sm">
            Add
        </a>
        <table class="table table-dark align-items-center table-dark">
            <thead class="thead-dark">
                <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Kelas</th>
                <th scope="col">Kompetensi Keahlian</th>
                <th scope="col">Handle</th>
                </tr>
            </thead>
            <tbody class="list">
                @foreach ($getData as $item)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{$item->nama_kelas}}</td>
                        <td>{{$item->kompetensi_keahlian}}</td>
                        <td class="d-flex">
                              <a class="mt-1 btn btn-sm btn-success" href="{{ url('kelas/'. $item->id. '/edit')}}">
                                Edit
                              </a>
                                <form action="{{ url('kelas/'.$item->id) }}" method="POST" class="ml-5">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="id" value="{{$item->id}}">
                                <button type="submit" class="btn btn-sm btn-danger ms-3 mt-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
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
