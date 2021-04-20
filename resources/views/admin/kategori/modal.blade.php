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
          <form id="add-form" action="{{route('kategori.index')}}" method="POST" class="form-kategori">
            @csrf
            <input type="hidden" name="_method" id="method">
            <div class="form-group">
              <label for="nama_kategori">Nama Kategori</label>
              <input type="text" class="form-control data" name="nama_kategori" id="nama_kategori" placeholder="Masukan Nama Kategori" autocomplete="off">
              <div id="invalid-feedback-nama_kategori" class="invalid-feedback"></div>
            </div>
            <button type="submit" id="btn-submit" class="btn btn-primary">Simpan</button>
          </form>
        </div>
      </div>
    </div>
</div>