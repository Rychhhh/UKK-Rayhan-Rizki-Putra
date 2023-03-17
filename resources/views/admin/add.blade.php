@extends('layouts.temp')

@section('breadcrumb')
<div class="row">
    <div class="card card-stats">
        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
            <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Dashboards</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add Users</li>
          </ol>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="py-12">
    <div class=" max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <form action="{{ route('users.store')}}" method="POST">
            @csrf
            <input type="hidden" name="_method" value="POST">

            <div class="mb-3 form-group">
              <label for="exampleInputEmail1" class="form-control-label">Name</label>
              <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="nisn">
              <b class="form-control-label">Enter Your Name</b>
            </div>

            <div class="mb-3 form-group">
              <label for="exampleInputEmail1" class="form-control-label">Email</label>
              <input type="text" name="email" class="  form-control" id="exampleInputEmail1" aria-describedby="email">
              <b class="form-control-label">Enter Your Email</b>
            </div>

            <div class="mb-3 form-group">
              <label for="exampleInputEmail1" class="form-control-label">Password</label>
              <input type="password" name="password" class="form-control" id="exampleInputEmail1" aria-describedby="email">
              <b class="form-control-label">Enter Your Password</b>
            </div>

            <div class="mb-3 d-flex flex-col">
              <label for="exampleInputEmail1" class="form-control-label">Role</label>
                <select name="role" >
                    <option value="administrator">Administrator</option>
                    <option value="petguas">Petugas</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
    </div>
</div>
</div>
@endsection