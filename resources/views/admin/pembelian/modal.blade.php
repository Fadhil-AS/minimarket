<div class="modal fade" id="modal-barang" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Barang</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="table-responsive">
                <table class="table table-bordered table-barang" id="table-barang" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Barang</th>
                            <th>Nama</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($barang as $r)
                            <tr>
                                <td>{{$no++}}</td>
                                <td> {{$r->kode_barang}} </td>
                                <td>{{$r->nama_barang}}</td>
                                <td> {{$r->harga_jual}} </td>
                                <td>
                                    <button class="btn btn-success pilihBarangBtn"><i class="fas fa-cart-plus"></i></button>
                                </td>
                          </tr>      
                        @endforeach 
                    </tbody>
                </table>
            </div>
        </div>
      </div>
    </div>
</div>