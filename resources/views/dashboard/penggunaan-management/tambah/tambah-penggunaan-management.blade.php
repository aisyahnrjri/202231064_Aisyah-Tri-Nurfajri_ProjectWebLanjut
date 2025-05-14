<!-- Button trigger modal -->
<button type="button" class="btn bg-gradient-primary btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#tambah-penggunaan">
  +&nbsp; Penggunaan
</button>

<!-- Modal -->
<div class="modal fade" id="tambah-penggunaan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-body">
        <h5 class="mb-3">Tambah Penggunaan</h5>
        <form action="{{url('detail-penggunaan-listrik/tambah')}}" method="POST" role="form text-left">
          @csrf
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="bulan" class="form-control-label">{{ __('Bulan') }}</label>
                <div class="@error('bulan') border border-danger rounded-3 @enderror">
                  <input type="hidden" name="id_pelanggan" value="{{ $pelanggan->id_pelanggan }}">
                  <select id="bulan" name="bulan" class="form-select">
                    <option value="Januari">Januari</option>
                    <option value="Febuari">Februari</option>
                    <option value="Maret">Maret</option>
                    <option value="April">April</option>
                    <option value="Mei">Mei</option>
                    <option value="Juni">Juni</option>
                    <option value="Juli">Juli</option>
                    <option value="Agustus">Agustus</option>
                    <option value="September">September</option>
                    <option value="Oktober">Oktober</option>
                    <option value="November">November</option>
                    <option value="Desember">Desember</option>
                  </select>
                  @error('bulan')
                  <p class="text-danger text-xs mt-2">{{ $message }}</p>
                  @enderror
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="tahun" class="form-control-label">{{ __('Tahun') }}</label>
                <div class="@error('tahun') border border-danger rounded-3 @enderror">
                  <input class="form-control" type="number" name="tahun" max="2100" placeholder="YYYY" required>
                  @error('tahun')
                  <p class="text-danger text-xs mt-2">{{ $message }}</p>
                  @enderror
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="meter_awal" class="form-control-label">{{ __('Meter Awal') }}</label>
                <div class="@error('meter_awal') border border-danger rounded-3 @enderror">
                  <input class="form-control" type="number" placeholder="Meter Awal" name="meter_awal" value="{{ $meterAkhir ?? 0 }}" readonly>
                  @error('meter_awal')
                  <p class="text-danger text-xs mt-2">{{ $message }}</p>
                  @enderror
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="meter_akhir" class="form-control-label">{{ __('Meter Akhir') }}</label>
                <div class="@error('meter_akhir') border border-danger rounded-3 @enderror">
                  <input class="form-control" type="number" placeholder="Meter Akhir" name="meter_akhir" required>
                  @error('meter_akhir')
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