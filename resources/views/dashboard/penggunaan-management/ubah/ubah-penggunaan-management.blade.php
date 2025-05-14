<!-- Modal -->
<div class="modal fade" id="editPenggunaanModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-body">
        <h5 class="mb-3">Ubah Penggunaan</h5>
        <form action="{{url('detail-penggunaan-listrik/update')}}" method="POST" role="form text-left">
          @csrf
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="bulan" class="form-control-label">{{ __('Bulan') }}</label>
                <div class="@error('bulan') border border-danger rounded-3 @enderror">
                  <input type="hidden" name="id_pelanggan" value="{{ $pelanggan->id_pelanggan }}">
                  <input type="hidden" name="id_penggunaan" id="id_penggunaan">
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
                  <input class="form-control" type="number" name="tahun" id="tahun" max="2100" placeholder="YYYY" required>
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
                  <input class="form-control" type="number" placeholder="Meter Awal" id="meter_awal" name="meter_awal" readonly>
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
                  <input class="form-control" type="number" placeholder="Meter Akhir" id="meter_akhir" name="meter_akhir" required>
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

<script>
  function editPenggunaan(button) {
    const penggunaanId = button.getAttribute('data-id');
    $.ajax({
      type: "GET",
      url: "{{url('detail-penggunaan-listrik/put')}}/" + penggunaanId,
      success: function(ambil) {
        $('#id_penggunaan').val(ambil.id_penggunaan);
        $('#bulan').val(ambil.bulan);
        $('#tahun').val(ambil.tahun);
        $('#meter_awal').val(ambil.meter_awal);
        $('#meter_akhir').val(ambil.meter_akhir);
        $('#editPenggunaanModal').modal('show');
      },
      error: function() {
        alert('gagal proses');
      }
    });
  }
</script>