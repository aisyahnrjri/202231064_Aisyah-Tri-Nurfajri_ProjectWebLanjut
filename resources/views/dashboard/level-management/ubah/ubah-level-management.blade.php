<!-- Modal -->
<div class="modal fade" id="editLevelModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-body">
        <h5 class="mb-3">Ubah Level</h5>
        <form action="{{url('pengaturan-level/update')}}" method="POST" role="form text-left">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="nama_level" class="form-control-label">{{ __('Nama Level') }}</label>
                <div class="@error('nama_level') border border-danger rounded-3 @enderror">
                  <input type="hidden" id="id_level" name="id_level">
                  <input class="form-control" type="text" placeholder="Nama Level" id="nama_level" name="nama_level" required>
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

<script>
  function editLevel(button) {
    const userId = button.getAttribute('data-id');
    $.ajax({
      type: "GET",
      url: "{{url('pengaturan-level/put')}}/" + userId,
      success: function(ambil) {
        $('#id_level').val(ambil.id_level);
        $('#nama_level').val(ambil.nama_level);
        $('#editLevelModal').modal('show');
      },
      error: function() {
        alert('gagal proses');
      }
    });
  }
</script>