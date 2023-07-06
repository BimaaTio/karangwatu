{{-- @dd($data) --}}
@extends('layouts.dashboard')
@section('content')
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Edit Akun : {{ $data->nama }}</h6>
    <a href="/dashboard/admin/users" class="btn btn-sm btn-success my-1">Kembali</a>
  </div>
  <div class="card-body">
    <form action="{{ route('users.update', $data->id) }}" method="post" enctype="multipart/form-data">
      @method('PUT')
      @csrf
      <div class="form-group">
        <label for="exampleFormControlInput1">Nama</label>
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="exampleFormControlInput1" value="{{ old('name', $data->name) }}">
        @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
      <div class="form-group">
        <label for="exampleFormControlInput1">Email</label>
        <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" id="exampleFormControlInput1" value="{{ old('email', $data->email) }}">
        @error('email')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</div>
@endsection