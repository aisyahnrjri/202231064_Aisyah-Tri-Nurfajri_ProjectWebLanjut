<!-- Button trigger modal -->
<button type="button" class="btn bg-gradient-primary btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#tambah-user">
  +&nbsp; Tarif
</button>

<!-- Modal -->
<div class="modal fade" id="tambah-user" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-body">
        <h5 class="mb-3">Tambah Tarif</h5>
        <form action="{{url('pengaturan-tarif/tambah')}}" method="POST" role="form text-left">
          @csrf
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="daya" class="form-control-label">{{ __('Daya') }}</label>
                <div class="@error('daya') border border-danger rounded-3 @enderror">
                  <input class="form-control" type="text" placeholder="Daya" name="daya" maxlength="15" required>
                  @error('daya')
                  <p class="text-danger text-xs mt-2">{{ $message }}</p>
                  @enderror
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="tarif" class="form-control-label">{{ __('Tarif Per KWH') }}</label>
                <div class="@error('tarif') border border-danger rounded-3 @enderror">
                  <input class="form-control" type="number" placeholder="Tarif Per KWH" name="tarifperkwh" maxlength="11" required>
                  @error('tarif')
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