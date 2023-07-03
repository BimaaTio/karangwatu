@extends('layouts.dashboard')
@section('title', 'List Berita')
@section('content')
@php($no=1)
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
    <button class="btn btn-sm btn-success mt-2" data-toggle="modal" data-target="#tambahBerita">Buat Berita</button>
    <a href="{{ route('kategori.index') }}" class="btn btn-sm btn-primary mt-2">List Kategori</a>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered table-strip" id="listBerita" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>No</th>
            <th>Foto</th>
            <th>Judul</th>
            <th>Post By</th>
            <th>Kategori</th>
            <th>Status</th>
            <th>Tgl Dibuat</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @if($data->count() > 0)
          @foreach($data as $news)
          <tr>
            <td>{{ $no++ }}</td>
            <td><img width="175" height="175" src="{{ asset('storage/'. $news->foto) }}" alt="{{ asset('storage/'. $news->foto) }}"></td>
            <td>{{ $news->judul }}</td>
            <td>{{ $news->user->name }}</td>
            <td>{{ $news->kategori->nama }}</td>
            <td>
              @if($news->status == 'published')
              <span class="badge badge-success">Publish</span>
              @elseif($news->status == 'draft')
              <span class="badge badge-warning">Draft</span>
              @endif
            </td>
            <td>{{ $news->created_at->toDayDateTimeString() }}</td>
            <td>
              <a href="{{ route('news.edit', $news->slug) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
              <form id="deleteData" action="{{ route('news.destroy',$news->slug) }}" method="post" class="d-inline">
                @method('delete')
                @csrf
                <button class="btn btn-sm btn-danger border-0" onclick="return confirm('Yakin mau dihapus?')" type="submit"><i class="fas fa-trash"></i></button>
              </form>
            </td>
          </tr>
          @endforeach
          @else
          @endif

        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Modal Tambah Berita -->
<div class="modal fade" id="tambahBerita" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <form @if(Auth::user()->roles == 'admin' ) action="/dashboard/admin/news" @elseif(Auth::user()->roles == 'user') action="/dashboard/user/news" @endif method="post" enctype="multipart/form-data">
      @csrf
      <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" id="user_id">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Buat Berita</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group row">
            <label for="judul" class="col-sm-2 col-form-label">Judul</label>
            <div class="col-sm-10">
              <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" value="{{ old('judul') }}">
              @error('judul')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>
          <div class="form-group row">
            <label for="kontenBerita" class="col-sm-2 col-form-label">Konten</label>
            <div class="col-sm-10">
              <textarea name="body" class="@error('body') is-invalid @enderror" id="kontenBerita" cols="30" rows="10">{{ old('body') }}</textarea>
              @error('body')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>
          <div class="form-group row">
            <label for="kategori" class="col-sm-2 col-form-label">Kategori</label>
            <div class="col-sm-10">
              <select class="custom-select @error('kategori_id') is-invalid @enderror" name="kategori_id" id="kategori">
                @foreach($kategori as $k)
                @if(old('katefori_id') == $k->id)
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
<!--?end Modal tambah berita -->
@endsection