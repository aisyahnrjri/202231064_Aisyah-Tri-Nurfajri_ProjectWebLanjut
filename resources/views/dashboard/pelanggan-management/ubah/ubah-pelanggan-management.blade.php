<!-- Modal -->
<div class="modal fade" id="editPelangganModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-body">
        <h5 class="mb-3">Ubah Pelanggan</h5>
        <form action="{{url('pengaturan-pelanggan/update')}}" method="POST" role="form text-left">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="nama_pelanggan" class="form-control-label">{{ __('Nama Pelanggan') }}</label>
                <div class="@error('nama_pelanggan') border border-danger rounded-3 @enderror">
                  <input type="hidden" name="id_pelanggan" id="id_pelanggan">
                  <input class="form-control" type="text" placeholder="Nama Pelanggan" name="nama_pelanggan" id="nama_pelanggan" maxlength="50" required>
                  @error('nama_pelanggan')
                  <p class="text-danger text-xs mt-2">{{ $message }}</p>
                  @enderror
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="username" class="form-control-label">{{ __('Username') }}</label>
                <div class="@error('username') border border-danger rounded-3 @enderror">
                  <input class="form-control" type="text" placeholder="Username" name="username" id="username" maxlength="50" disabled>
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
                  <input class="form-control" type="password" placeholder="Password Baru" name="password" id="password" maxlength="20">
                  @error('password')
                  <p class="text-danger text-xs mt-2">{{ $message }}</p>
                  @enderror
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="nomor_kwh" class="form-control-label">{{ __('Nomor KWH') }}</label>
                <div class="@error('nomor_kwh') border border-danger rounded-3 @enderror">
                  <input class="form-control" type="number" placeholder="Nomor KWH" name="nomor_kwh" id="nomor_kwh" readonly>
                  @error('nomor_kwh')
                  <p class="text-danger text-xs mt-2">{{ $message }}</p>
                  @enderror
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="id_tarif" class="form-control-label">{{ __('Tarif') }}</label>
                <div class="@error('id_tarif') border border-danger rounded-3 @enderror">
                  <select class="form-select" name="id_tarif" id="id_tarif" required>
                    <option selected value="">-- Pilih Tarif --</option>
                    @foreach($tarifs as $tarif)
                    <option value='{{ $tarif->id_tarif }}'>{{$tarif->daya}} - Rp {{number_format($tarif->tarifperkwh, 0, ',', '.')}}</option>
                    @endforeach
                  </select>
                  @error('id_tarif')
                  <p class="text-danger text-xs mt-2">{{ $message }}</p>
                  @enderror
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label for="alamat" class="form-control-label">{{ __('Alamat') }}</label>
                <div class="@error('alamat') border border-danger rounded-3 @enderror">
                  <textarea name="alamat" id="alamat" class="form-control" placeholder="Alamat" rows="5"></textarea>
                  @error('id_tarif')
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