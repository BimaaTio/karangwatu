{{-- @dd($user) --}}
@extends('layouts.dashboard')
@section('content')
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Edit Profile</h6>
    <a href="{{ back() }}" class="btn btn-sm btn-success my-1">Kembali</a>
  </div>
  @if ($errors->any())
  <div>
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif
  <form class="user" method="post" action="/dashboard/admin/profile">
    @method('patch')
    @csrf
    <div class="card-body">
      <div class="form-group">
        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $data->name) }}" id="name" placeholder="Nama Lengkap">
        @error('name')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="form-group">
        <input type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $data->email) }}" name="email" id="exampleInputEmail" placeholder="Email Address">
        @error('email')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </div>
  </form>
</div>
@endsection