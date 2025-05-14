<!-- Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-body">
        <h5 class="mb-3">Ubah Pengguna</h5>
        <form action="{{url('pengaturan-pengguna/update')}}" method="POST" role="form text-left">
          @csrf
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="nama_admin" class="form-control-label">{{ __('Nama Lengkap') }}</label>
                <div class="@error('nama_admin') border border-danger rounded-3 @enderror">
                  <input type="hidden" id="id_user" name="id_user">
                  <input class="form-control" type="text" placeholder="Nama Lengkap" id="nama_admin" name="nama_admin" required>
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
                  <input class="form-control" type="text" placeholder="Username" id="username" name="username" required>
                  @error('username')
                  <p class="text-danger text-xs mt-2">{{ $message }}</p>
                  @enderror
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="password" class="form-control-label">{{ __('Password Baru') }}</label>
                <div class="@error('password') border border-danger rounded-3 @enderror">
                  <input class="form-control" type="password" placeholder="Password Baru" id="password" name="password">
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
                  <select class="form-select" name="id_level" id="id_level" required>
                    <option selected value="">-- Pilih Level --</option>
                    @foreach($level as $levels)
                    <option value="{{ $levels->id_level }}">
                      {{ $levels->nama_level }}
                    </option>
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

<script>
  function editUser(button) {
    const userId = button.getAttribute('data-id');
    $.ajax({
      type: "GET",
      url: "{{url('pengaturan-pengguna/put')}}/" + userId,
      success: function(ambil) {
        $('#id_user').val(ambil.id_user);
        $('#nama_admin').val(ambil.nama_admin);
        $('#username').val(ambil.username);
        $('#id_level').val(ambil.id_level);
        $('#editUserModal').modal('show');
      },
      error: function() {
        alert('gagal proses');
      }
    });
  }
</script>