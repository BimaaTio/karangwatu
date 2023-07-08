@extends('layouts.dashboard')
@section('title', 'List Acara')
@section('content')
@php($no=1)
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
    <button class="btn btn-sm btn-success mt-2" data-toggle="modal" data-target="#tambahBerita">Tambah Acara</button>
    <a href="{{ route('kategori.index') }}" class="btn btn-sm btn-primary mt-2">List Kategori</a>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered table-strip" id="listBerita" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>No</th>
            <th>Foto</th>
            <th>Nama Acara</th>
            <th>Waktu Acara</th>
            <th>Dibuat Oleh</th>
            <th>Kategori</th>
            <th>Status</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @foreach($data as $acara)
          <tr class="text-center">
            <td>{{ $no++ }}</td>
            <td><img src="{{ asset('storage/'.$acara->foto) }}" width="125" height="125" alt=""></td>
            <td>{{ $acara->nama_acara }}</td>
            <td>{{ $acara->waktu_acara }}</td>
            <td>{{ $acara->user->name }}</td>
            <td>{{ $acara->kategori->nama }}</td>
            <td> @if($acara->status == 'published')
              <span class="badge badge-success">Publish</span>
              @elseif($acara->status == 'draft')
              <span class="badge badge-warning">Draft</span>
              @endif
            </td>
            <td>
              <a href="{{ route('acara.edit', $acara->slug) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
              <form id="deleteData" action="{{ route('acara.destroy', $acara->slug) }}" method="post" class="d-inline">
                @method('delete')
                @csrf
                <button class="btn btn-sm btn-danger border-0" onclick="return confirm('Yakin mau dihapus?')" type="submit"><i class="fas fa-trash"></i></button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>


<!-- Modal Tambah Acara -->
<div class="modal fade" id="tambahBerita" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <form action="{{ route('acara.store') }}" method="post" enctype="multipart/form-data">
      @csrf
      <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" id="user_id">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Buat Acara</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group row">
            <label for="nama_acara" class="col-sm-2 col-form-label">Nama Acara</label>
            <div class="col-sm-10">
              <input type="text" class="form-control @error('nama_acara') is-invalid @enderror" id="nama_acara" name="nama_acara" value="{{ old('nama_acara') }}">
              @error('nama_acara')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>
          <div class="form-group row">
            <label for="waktu_acara" class="col-sm-2 col-form-label">Waktu Acara</label>
            <div class="col-sm-10">
              <input class="form-control @error('waktu_acara') is-invalid @enderror" id="datepicker" name="waktu_acara" value="{{ old('waktu_acara') }}">
              @error('waktu_acara')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>
          <div class="form-group row">
            <label for="kontenBerita" class="col-sm-2 col-form-label">Deskripsi</label>
            <div class="col-sm-10">
              <textarea name="deskripsi" class="@error('deskripsi') is-invalid @enderror" id="kontenBerita" cols="30" rows="10">{{ old('deskripsi') }}</textarea>
              @error('deskripsi')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>
          <div class="form-group row">
            <label for="kategori" class="col-sm-2 col-form-label">Kategori</label>
            <div class="col-sm-10">
              <select class="custom-select @error('kategori_id') is-invalid @enderror" name="kategori_id" id="kategori">
                @foreach($kategori as $k)
                @if(old('kategori_id') == $k->id)
                <option value="{{ $k->id }}" selected>{{ $k->nama }}</option>
                @else
                <option value="{{ $k->id }}">{{ $k->nama }}</option>
                @endif
                @endforeach
              </select>
              @error('kategori')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>
          <div class="form-group row">
            <label for="" class="col-sm-2 col-form-label">Foto</label>
            <div class="custom-file col-sm-10">
              <input name="foto" type="file" class="custom-file-input @error('foto') is-invalid @enderror" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04">
              <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
              @error('foto')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </form>
  </div>
</div>
<!--?end Modal tambah Acara -->
@endsection