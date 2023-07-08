{{-- @dd($kategori) --}}
@extends('layouts.dashboard')
@section('title', 'List Slider')
@section('content')

@php($no=1)
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
    <button class="btn btn-sm btn-success mt-2" data-toggle="modal" data-target="#uploadGaleri">Upload Slider</button>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered table-strip" id="listBerita" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th width="3%">No</th>
            <th width="20%">Foto</th>
            <th>Judul</th>
            <th>Post By</th>
            <th width="5%"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($data as $slider)
          <tr>
            <td>{{ $no++ }}</td>
            <td>
              <img src="{{ asset('storage/'. $slider->foto) }}" width="175" height="175" alt="{{ asset('storage/slider/'. $slider->foto) }}">
            </td>
            <td>{{ $slider->judul }}</td>
            <td>{{ $slider->user->name }}</td>
            <td>
              <!-- <a href="{{ route('slider.edit' ,$slider->slug) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a> -->
              <form id="deleteData" action="{{ route('slider.destroy', $slider->slug) }}" method="post" class="d-inline">
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
    <form action="{{ route('slider.store') }}" method="post" enctype="multipart/form-data">
      @csrf
      <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" id="user_id">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Upload Foto / Gif</h5>
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
          <input type="hidden" name="kategori_id" id="" value="{{ $kategori->id }}">
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