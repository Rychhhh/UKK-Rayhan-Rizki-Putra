@extends('layouts.temp')

@section('breadcrumb')
<div class="row">
    <div class="card card-stats">
        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
            <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Dashboards</a></li>
            <li class="breadcrumb-item active" aria-current="page">Kelas</li>
          </ol>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
    <a href="{{ route('kelas.create')}}" class="btn btn-success btn-sm">
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
                          <a class="mt-1 btn btn-sm btn-success" href="{{ url('kelas/'. $item->id_kelas. '/edit')}}">
                            Edit
                          </a>
                            <form action="{{ url('kelas/'.$item->id_kelas) }}" method="POST" class="ml-5">
                            @csrf
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="id_kelas" value="{{$item->id_kelas}}">
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