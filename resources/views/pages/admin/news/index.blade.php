@extends('layouts.dashboard')
@section('title', 'List Berita')
@section('content')
@php($no=1)
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
    <button class="btn btn-sm btn-success my-1" data-toggle="modal" data-target="#tambahBerita">Buat Berita</button>
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
          @foreach($data as $row)
          <tr>
            <td>{{ $no++ }}</td>
            <td><img width="175" height="175" src="{{ asset('storage/'. $row->foto) }}" alt="{{ asset('storage/'. $row->foto) }}"></td>
            <td>{{ $row->judul }}</td>
            <td>{{ $row->user->name }}</td>
            <td>{{ $row->kategori->nama }}</td>
            <td>
              @if($row->status == 'published')
              <span class="badge badge-success">Publish</span>
              @elseif($row->status == 'draft')
              <span class="badge badge-warning">Draft</span>
              @endif
            </td>
            <td>{{ $row->created_at->toDayDateTimeString() }}</td>
            <td>
              <a href="{{ route('news.edit', $row->slug) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
              <form id="deleteData" action="{{ route('news.destroy',$row->slug) }}" method="post" class="d-inline">
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
@endsection