<!-- Button trigger modal -->
<button type="button" class="btn bg-gradient-primary btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#tambah-user">
  +&nbsp; level
</button>

<!-- Modal -->
<div class="modal fade" id="tambah-user" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-body">
        <h5 class="mb-3">Tambah Level</h5>
        <form action="{{url('pengaturan-level/tambah')}}" method="POST" role="form text-left">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="nama_level" class="form-control-label">{{ __('Nama Level') }}</label>
                <div class="@error('nama_level') border border-danger rounded-3 @enderror">
                  <input class="form-control" type="text" placeholder="Nama Level" name="nama_level" maxlength="50" required>
                  @error('nama_level')
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