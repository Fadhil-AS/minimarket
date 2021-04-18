<div class="modal fade" id="form-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modal-label"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="add-form" action="{{route('pemasokan.index')}}" method="POST" class="form-pemasok">
            @csrf
            <input type="hidden" name="_method" id="method">
            <div class="form-group">
              <label for="kode_pemasok">Kode Pemasok</label>
              <input type="text" class="form-control" name="kode_pemasok" id="kode_pemasok" value="{{str_shuffle(mt_rand(1, 99999999))}}" readonly>
              <div id="invalid-feedback-kode_pemasok" class="invalid-feedback"></div>
            </div>
            <div class="form-group">
              <label for="nama_pemasok">Nama Pemasok</label>
              <input type="text" class="form-control data" name="nama_pemasok" id="nama_pemasok" placeholder="Masukan nama pemasok" autocomplete="off">
              <div id="invalid-feedback-nama_pemasok" class="invalid-feedback"></div>
            </div>
            <div class="form-group">
              <label for="alamat">Alamat</label>
              <textarea name="alamat" id="alamat" cols="30" rows="10" id="alamat" placeholder="Masukan alamat" class="form-control data"></textarea>
              <div id="invalid-feedback-alamat" class="invalid-feedback"></div>
            </div>
            <div class="form-group">
              <label for="kota">Kota</label>
              <input type="text" name="kota" id="kota" class="form-control data" placeholder="Masukan kota" autocomplete="off">
              <div id="invalid-feedback-kota" class="invalid-feedback"></div>
            </div>
            <div class="form-group">
                <label for="no_telp">Nomor telephone</label>
                <input type="number" class="form-control data" name="no_telp" id="no_telp" placeholder="Masukan No Telephone" autocomplete="off" required>
                <div id="invalid-feedback-no_telp" class="invalid-feedback"></div>
            </div>
            <button type="submit" id="btn-submit" class="btn btn-primary">Simpan</button>
          </form>
        </div>
      </div>
    </div>
</div>