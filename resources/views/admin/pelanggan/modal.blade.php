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
          <form id="add-form" action="{{route('pelanggan.index')}}" method="POST" class="form-pelanggan">
            @csrf
            <input type="hidden" name="_method" id="method">
            <div class="form-group">
              <label for="kode_pelanggan">Kode Pelanggan</label>
              <input type="text" class="form-control" name="kode_pelanggan" id="kode_pelanggan" value="K{{str_shuffle(mt_rand(1, 99999999))}}" readonly>
              <div id="invalid-feedback-kode_pelanggan" class="invalid-feedback"></div>
            </div>
            <div class="form-group">
              <label for="nama">Nama</label>
              <input type="text" class="form-control data" name="nama" id="nama" placeholder="Masukan nama" autocomplete="off">
              <div id="invalid-feedback-nama" class="invalid-feedback"></div>
            </div>
            <div class="form-group">
              <label for="alamat">Alamat</label>
              <textarea name="alamat" id="alamat" cols="30" rows="10" placeholder="Masukan Alamat" class="form-control data"></textarea>
              <div id="invalid-feedback-alamat" class="invalid-feedback"></div>
            </div>
            <div class="form-group">
              <label for="no_telp">No Handphone</label>
              <input type="number" class="form-control data" name="no_telp" id="no_telp" placeholder="Masukan No Handphone" autocomplete="off">
              <div id="invalid-feedback-no_telp" class="invalid-feedback"></div>
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" class="form-control data" name="email" id="email" placeholder="Masukan email" autocomplete="off">
              <div id="invalid-feedback-email" class="invalid-feedback"></div>
            </div>
            <button type="submit" id="btn-submit" class="btn btn-primary">Simpan</button>
          </form>
        </div>
      </div>
    </div>
</div>