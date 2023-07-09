@extends('layouts.dashboard')
@section('title', 'List Kategori')
@section('content')
@php($no=1)
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
    <button class="btn btn-sm btn-primary mt-2" data-toggle="modal" data-target="#tambahKategori">Tambah Kategori</button>
    <div class="mt-4">
      NB : Jangan Asal Mengubah Nama Kategori!
    </div>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered table-strip" id="listKategori" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th class="text-center" width="10%">No</th>
            <th>Nama</th>
            <th>Dibuat Tgl</th>
            <th width="15%"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($kategori as $k)
          <tr>
            <td class="text-center">{{ $no++ }}</td>
            <td>{{ $k->nama }}</td>
            <td>{{ date('d F Y', strtotime($k->created_at)) }}</td>
            <td class="text-center">
              <a href="{{ route('user.kategori.edit', $k->slug) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Modal Kategori -->
<div class="modal fade" id="tambahKategori" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="{{ route('user.kategori.store') }}" method="post">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Kategori</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group row">
            <label for="nama" class="col-sm-4 col-form-label">Nama Kategori</label>
            <div class="col-sm-8">
              <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama') }}">
              @error('nama')
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
<!-- /End Modal Kategori -->
@endsection