{{-- @dd($data) --}}
@extends('layouts.dashboard')
@section('content')
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Edit Galeri : {{ $data->judul }}</h6>
    @if(Auth::user()->roles == 'admin' )
    <a href="/dashboard/admin/galeri" class="btn btn-sm btn-success my-1">Kembali</a>
    @elseif(Auth::user()->roles == 'user')
    <a href="/dashboard/user/galeri" class="btn btn-sm btn-success my-1">Kembali</a>
    @endif
  </div>
  <div class="card-body">
    <form action="/dashboard/admin/galeri/{{ $data->id }}" method="post" enctype="multipart/form-data">
      @method('PUT')
      @csrf
      <input type="hidden" name="slug" value="{{ old('slug',$data->slug) }}" id="">
      <div class="form-group">
        <label for="exampleFormControlInput1">Judul</label>
        <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" id="exampleFormControlInput1" value="{{ old('judul', $data->judul) }}">
        @error('judul')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
      <div class="form-group">
        <label for="">Kategori</label>
        <select name="kategori_id" class="form-control @error('kategori_id') is-invalid @enderror" id="exampleFormControlSelect1">
          @foreach($kategori as $k)
          @if(old('kategori_id', $data->kategori_id) == $k->id)
          <option value="{{ $k->id }}" selected>{{ $k->nama }}</option>
          @else
          <option value="{{ $k->id }}">{{ $k->nama }}</option>
          @endif
          @endforeach
        </select>
        @error('kategori_id')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        </select>
      </div>
      <div class="form-group">
        <label for="">Status</label>
        <select name="status" class="form-control @error('status') is-invalid @enderror" id="exampleFormControlSelect1">
          <option selected value="{{ $data->status }}">Status sekarang : {{ ucwords($data->status) }}</option>
          <option value="published">Published</option>
          <option value="draft">Draft</option>
        </select>
        @error('status')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
      <div class="form-group">
        <label for="exampleFormControlInput1">Url</label>
        <input type="text" name="url" class="form-control @error('url') is-invalid @enderror" id="exampleFormControlInput1" value="{{ old('url', $data->url) }}">
        @error('url')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
      <div class="form-group">
        <label for="">Foto</label>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
          </div>
          <div class="custom-file">
            <input type="hidden" name="oldFoto" value="{{ $data->foto }}">
            <input type="file" name="foto" class="custom-file-input @error('foto') is-invalid @enderror" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
            @error('foto')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
        </div>
      </div>
      <div class="form-group">
        <label for="">Konten</label>
        <textarea name="body" class="@error('body') is-invalid @enderror" id="kontenBerita" cols="30" rows="10">{{ old('body', $data->body) }}</textarea>
        @error('body')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</div>
@endsection