@extends('layouts.dashboard')
@section('title', 'List Berita')
@section('content')
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
    <button class="btn btn-sm btn-success my-1" data-toggle="modal" data-target="#tambahBerita">Buat Berita</button>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="listBerita" width="100%" cellspacing="0">
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
          <tr>
            <td>Tiger Nixon</td>
            <td>System Architect</td>
            <td>Edinburgh</td>
            <td>61</td>
            <td>2011/04/25</td>
            <td>$320,800</td>
            <td>1</td>
            <td>
              <a href="/dashboard/admin/news/slug/edit" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
              <form action="" class="d-inline">
                <button class="btn btn-sm btn-danger border-0"><i class="fas fa-trash"></i></button>
              </form>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection