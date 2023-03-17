@extends('dashboard')
@section('content')

    <div class="py-12">
        <div class=" max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <form action="{{ url('user/'. $user->id)}}" method="POST">
                @csrf
                <input type="hidden" name="_method" value="PATCH">
                <input type="hidden" name="id" value="{{ $user->id }}">

                <div class="mb-3 ">
                  <label for="exampleInputEmail1" class="form-control-label">Name</label>
                  <input type="text" name="name" value="{{ $user->name }}" class="form-control " id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-control-label">Email</label>
                  <input type="email" name="email" value="{{ $user->email }}" class="form-control bg-gray-80" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-control-label">Password</label>
                  <input type="password" name="password" class="form-control bg-gray-800" id="exampleInputPassword1">
                </div>
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-control-label">Password</label>
                  <select class="form-select" aria-label="Default select example" name="role">
                    <option value="administrator">Administrator</option>
                    <option value="petugas">Petugas</option>
                    <option value="siswa">Siswa</option>
                  </select>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
        </div>
    </div>
  </div>
@endsection