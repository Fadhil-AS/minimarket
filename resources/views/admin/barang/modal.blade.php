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
          <form id="add-form" action="{{route('barang.index')}}" method="POST" class="form-barang">
            @csrf
            <input type="hidden" name="_method" id="method">
            <div class="form-group">
              <label for="kode_barang">Kode Barang</label>
              <input type="text" class="form-control" name="kode_barang" id="kode_barang" value="{{$kode}}" readonly>
              <div id="invalid-feedback-kode_barang" class="invalid-feedback"></div>
            </div>
            <div class="form-group">
              <label for="produk_id">Produk</label>
              <select name="produk_id" id="produk_id" class="form-control data">
                @foreach ($produk as $p)
                  <option value="{{$p->id}}">{{$p->nama_produk}}</option>
                @endforeach
              </select>
              <div id="invalid-feedback-produk_id" class="invalid-feedback"></div>
            </div>
            <div class="form-group">
              <label for="nama_barang">Nama Barang</label>
              <input type="text" class="form-control data" name="nama_barang" id="nama_barang" placeholder="Masukan nama barang" autocomplete="off">
              <div id="invalid-feedback-nama_barang" class="invalid-feedback"></div>
            </div>
            <div class="form-group">
              <label for="satuan">Satuan</label>
              <select name="satuan" id="satuan" class="form-control data">
                <option value="item">item</option>
                <option value="pcs">pcs</option>
                <option value="kardus">kardus</option>
              </select>
              <div id="invalid-feedback-satuan" class="invalid-feedback"></div>
            </div>
            <div class="form-group">
              <label for="harga_jual">Harga</label>
              <input type="number" class="form-control data" name="harga_jual" id="harga_jual" placeholder="Masukan harga" autocomplete="off">
              <div id="invalid-feedback-harga_jual" class="invalid-feedback"></div>
            </div>
            <div class="form-group">
              <label for="stok">Stok</label>
              <input type="number" class="form-control data" name="stok" id="stok" placeholder="Masukan stok" autocomplete="off">
              <div id="invalid-feedback-stok" class="invalid-feedback"></div>
            </div>
            <div class="form-group">
              <input type="hidden" class="form-control" name="users_id" id="users_id" value="{{auth()->user()->id}}">
            </div>
            <button type="submit" id="btn-submit" class="btn btn-primary">Simpan</button>
          </form>
        </div>
      </div>
    </div>
</div>