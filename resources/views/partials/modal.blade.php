<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
      <div class="modal-footer">
        <form action="/logout" method="post">
          @csrf
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary" href="login.html">Logout</button>
        </form>
      </div>
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