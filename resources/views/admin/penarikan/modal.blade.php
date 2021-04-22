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
          <form id="add-form" action="{{route('penarikan.index')}}" method="POST" class="form-penarikan">
            @csrf
            <input type="hidden" name="_method" id="method">
            <div class="form-group">
              <label for="barang_id">Nama Barang</label>
              <select name="barang_id" id="barang_id" class="form-control data">
                  @foreach ($barang as $b)
                      <option value="{{$b->id}}">{{$b->nama_barang}}</option>
                  @endforeach
              </select>
              <div id="invalid-feedback-barang_id" class="invalid-feedback"></div>
            </div>
            <div class="form-group">
              <label for="tgl_expired">Tanggal Expired</label>
              <input type="date" name="tgl_expired" id="tgl_expired" class="form-control data">
              <div id="invalid-feedback-tgl_expired" class="invalid-feedback"></div>
            </div>
            <button type="submit" id="btn-submit" class="btn btn-primary">Simpan</button>
          </form>
        </div>
      </div>
    </div>
</div>