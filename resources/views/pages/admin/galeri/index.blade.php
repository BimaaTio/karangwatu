@extends('layouts.dashboard')
@section('title', 'List Galeri')
@section('content')
@php($no=1)
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
    <button class="btn btn-sm btn-success mt-2" data-toggle="modal" data-target="#uploadGaleri">Upload Foto</button>
    <a href="{{ route('kategori.index') }}" class="btn btn-sm btn-primary mt-2">List Kategori</a>
    <div class="mt-4">
      <ul>
        Jika Ingin Upload vidio dari youtube :
        <li>contoh link : https://youtu.be/0lxjpIQHLFA </li>
        <li>Paste kode dibelakang youtu.be/ jadi <b>0lxjpIQHLFA</b></li>
        <li>Ketik <b>embed/</b> didepan kode yang di paste</li>
        <li>Contoh input : embed/0lxjpIQHLFA</li>
      </ul>
    </div>
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
            <th></th>
          </tr>
        </thead>
        <tbody>
          @foreach($data as $galeri)
          <tr>
            <td>{{ $no++ }}</td>
            <td>
              @if($galeri->foto == NULL && $galeri->url != str_contains($galeri->url,'embed'))
              <img src="{{ $galeri->url }}" width="175" height="175" alt="">
              @endif
              @if($galeri->foto == NULL && $galeri->url == str_contains($galeri->url,'embed'))
              <iframe width="175" height="175" src="https://youtube.com/{{ $galeri->url }}" frameborder="0" allowfullscreen></iframe>
              @endif
              @if($galeri->foto == true)
              <img src="{{ asset('storage/'. $galeri->foto) }}" width="175" height="175" alt="">
              @endif
            </td>
            <td>{{ $galeri->judul }}</td>
            <td>{{ $galeri->user->name }}</td>
            <td>{{ $galeri->kategori->nama }}</td>
            <td>
              @if($galeri->status == 'published')
              <span class="badge badge-success">Publish</span>
              @elseif($galeri->status == 'draft')
              <span class="badge badge-warning">Draft</span>
              @endif
            </td>
            <td>
              <a href="{{ route('galeri.edit', $galeri->slug) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
              <form id="deleteData" action="{{ route('galeri.destroy', $galeri->slug) }}" method="post" class="d-inline">
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



<!-- Modal Tambah Berita -->
<div class="modal fade" id="uploadGaleri" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <form @if(Auth::user()->roles == 'admin' ) action="/dashboard/admin/galeri" @elseif(Auth::user()->roles == 'user') action="/dashboard/user/galeri" @endif method="post" enctype="multipart/form-data">
      @csrf
      <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" id="user_id">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Upload Foto / Vidio</h5>
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
            <label for="kontenBerita" class="col-sm-2 col-form-label">Deskripsi</label>
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
            <label for="judul" class="col-sm-2 col-form-label">Url</label>
            <div class="col-sm-10">
              <input type="text" class="form-control @error('url') is-invalid @enderror" id="url" name="url" value="{{ old('url') }}">
              @error('url')
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
@endsection