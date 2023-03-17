@extends('dashboard')
@section('content')
        <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <a href="{{ route('user.create')}}" class="btn btn-sm btn-success">
            Add
        </a>
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
                @foreach ($getData as $item)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{$item->name}}</td>
                        <td>{{$item->email}}</td>
                        <td>{{$item->role}}</td>
                        <td>*********</td>
                        <td class="d-flex">
                              <a class="mt-1 btn btn-success btn-sm" href="{{ url('user/'. $item->id. '/edit')}}">
                                Edit
                              </a>
                                <form action="{{ url('user/'.$item->id) }}" method="POST" class="ml-5">
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
