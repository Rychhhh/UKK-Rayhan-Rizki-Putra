@php
    use App\Models\User;
    use App\Models\Pembayaran;

    $petugas = User::where('role', '=', 'petugas')->count();
    $siswa = User::where('role', '=', 'siswa')->count();
    $administrator = User::where('role', '=', 'administrator')->count();
    $transaksi = Pembayaran::all()->count();


@endphp


@extends('layouts.temp')


@section('breadcrumb')
<div class="row">
    <div class="card card-stats">
        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
            <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Dashboards</a></li>
            <li class="breadcrumb-item active" aria-current="page">Users</li>
          </ol>
        </div>
    </div>
</div>
@endsection

@section('content')

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
    <a href="{{ route('users.create')}}" class="btn btn-sm btn-success">
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
    
            <table class="table table-dark align-items-center">
        <thead class="thead-dark">
            <tr>
            <th scope="col">No</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Role</th>
            <th scope="col">Password</th>
            <th scope="col">Handle</th>
            </tr>
        </thead>
        <tbody class="list">
            @foreach ($user as $item)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{$item->name}}</td>
                    <td>{{$item->email}}</td>
                    <td>{{$item->role}}</td>
                    <td>*********</td>
                    <td class="d-flex">
                          <a class="mt-1 btn btn-success btn-sm" href="{{ url('users/'. $item->id. '/edit')}}">
                            Edit
                          </a>
                            <form action="{{ url('users/'.$item->id) }}" method="POST" class="ml-5">
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