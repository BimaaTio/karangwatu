{{-- @dd($data) --}}
@extends('layouts.dashboard')
@section('content')
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Edit Kategori : {{ $data->nama }}</h6>
    <a href="/dashboard/admin/kategori" class="btn btn-sm btn-success my-1">Kembali</a>
  </div>
  <div class="card-body">
    <form action="{{ route('kategori.update', $data->id) }}" method="post">
      @method('PUT')
      @csrf
      <div class="form-group">
        <label for="exampleFormControlInput1">Nama Kategori</label>
        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="exampleFormControlInput1" value="{{ old('nama', $data->nama) }}">
        @error('nama')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</div>
@endsection