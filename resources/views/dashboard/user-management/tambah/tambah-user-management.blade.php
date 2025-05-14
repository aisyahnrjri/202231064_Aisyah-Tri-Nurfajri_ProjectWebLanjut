<!-- Button trigger modal -->
<button type="button" class="btn bg-gradient-primary btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#tambah-user">
  +&nbsp; Pengguna
</button>

<!-- Modal -->
<div class="modal fade" id="tambah-user" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-body">
        <h5 class="mb-3">Tambah Pengguna</h5>
        <form action="{{url('pengaturan-pengguna/tambah')}}" method="POST" role="form text-left">
          @csrf
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="nama_admin" class="form-control-label">{{ __('Nama Lengkap') }}</label>
                <div class="@error('nama_admin') border border-danger rounded-3 @enderror">
                  <input class="form-control" type="text" placeholder="Nama Lengkap" name="nama_admin" maxlength="50" required>
                  @error('nama_admin')
                  <p class="text-danger text-xs mt-2">{{ $message }}</p>
                  @enderror
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="username" class="form-control-label">{{ __('Username') }}</label>
                <div class="@error('username') border border-danger rounded-3 @enderror">
                  <input class="form-control" type="text" placeholder="Username" name="username" minlength="5" maxlength="50" required>
                  @error('username')
                  <p class="text-danger text-xs mt-2">{{ $message }}</p>
                  @enderror
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="password" class="form-control-label">{{ __('Password') }}</label>
                <div class="@error('password') border border-danger rounded-3 @enderror">
                  <input class="form-control" type="password" placeholder="Password" minlength="5" maxlength="20" name="password" required>
                  @error('password')
                  <p class="text-danger text-xs mt-2">{{ $message }}</p>
                  @enderror
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="level" class="form-control-label">{{ __('Level') }}</label>
                <div class="@error('level') border border-danger rounded-3 @enderror">
                  <select class="form-select" name="id_level" required>
                    <option selected value="">-- Pilih Level --</option>
                    @foreach($level as $levels)
                    <option value='{{ $levels->id_level }}'>{{$levels->nama_level}}</option>
                    @endforeach
                  </select>
                  @error('level')
                  <p class="text-danger text-xs mt-2">{{ $message }}</p>
                  @enderror
                </div>
              </div>
            </div>
          </div>
          <div class="d-flex justify-content-between">
            <button type="button" class="btn btn-outline-primary btn-md mt-4 mb-4" data-bs-dismiss="modal">{{ 'batal' }}</button>
            <button type="submit" class="btn bg-gradient-primary btn-md mt-4 mb-4">{{ 'Simpan' }}</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>