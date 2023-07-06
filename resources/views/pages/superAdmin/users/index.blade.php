@extends('layouts.dashboard')
@section('content')
@php($no=1)
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
    <button class="btn btn-sm btn-primary mt-2" data-toggle="modal" data-target="#tambahKategori">Tambah User</button>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered table-strip" id="listKategori" width="100%" cellspacing="0">
        <thead>
          <tr class="text-center">
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Roles</th>
            <th width="10%"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($userForSa as $user)
          <tr class="text-center">
            <td>{{ $no++ }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>
              @switch($user->roles)
              @case('superAdmin')
              <span class="badge badge-primary">
                <i class="fas fa-globe"></i> Super Admin
              </span>
              @break

              @case('admin')
              <span class="badge badge-secondary">
                <i class="fas fa-user-secret"></i> Admin
              </span>
              @break

              @case('user')
              <span class="badge badge-success">
                <i class="fas fa-user"></i> User
              </span>
              @break

              @default
              {{-- Kode yang akan dieksekusi jika $userRole tidak cocok dengan kasus di atas --}}
              @endswitch
            </td>
            <td>
              <a href="{{ route('sa.users.edit', $user->id) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
              <form id="deleteData" action="#" method="post" class="d-inline">
                @method('delete')
                @csrf
                <button class="btn btn-sm btn-danger border-0" onclick="return confirm('Yakin mau dihapus?, Semua Data dari akun ini akan terhapus!')" type="submit"><i class="fas fa-trash"></i></button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Modal User -->
<div class="modal fade" id="tambahKategori" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <form action="{{ route('sa.users.store') }}" method="post">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Buat Akun</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" id="name" placeholder="Nama Lengkap">
            @error('name')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>
          <div class="form-group">
            <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror" value="{{ old('email') }}" name="email" id="exampleInputEmail" placeholder="Email Address">
            @error('email')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>
          <div class="form-group">
            <select class="form-control @error('roles') is-invalid @enderror" name="roles">
              <option selected>Silahkan Pilih Role</option>
              <option value="user">User</option>
              <option value="admin">Admin</option>
              <option value="superAdmin">Super Admin</option>
            </select>
            @error('roles')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>
          <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
              <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror" name="password" id="exampleInputPassword" placeholder="Password">
              @error('password')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>
            <div class="col-sm-6">
              <input type="password" class="form-control form-control-user @error('password_confirmation') is-invalid @enderror" name="password_confirmation" id="exampleRepeatPassword" placeholder="Repeat Password">
              @error('password_confirmation')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
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
<!-- /End Modal User -->
@endsection