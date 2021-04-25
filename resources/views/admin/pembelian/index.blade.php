<!DOCTYPE html>
<html lang="en">
    @extends('admin.templates.header')
    @push('style')
        
    @endpush
    @section('content')
    <body class="sb-nav-fixed">
      @include('admin.templates.navbar')
      <div id="layoutSidenav">
          <div id="layoutSidenav_nav">
             @include('admin.templates.sidebar')
          </div>
          <div id="layoutSidenav_content">
              <main>
                  <div class="container-fluid">
                      <h1 class="mt-4">Pembelian</h1>
                      <ol class="breadcrumb mb-4">
                          <li class="breadcrumb-item active">Pembelian</li>
                      </ol>

                      {{-- form transaksi --}}
                      <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-file-invoice-dollar mr-1"></i>
                            Form Pembelian
                        </div>
                        <div class="card-body">
                            <form action="" method="post" id="formTransaksi">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="kode_masuk">Kode Masuk</label>
                                        <input type="text" class="form-control" name="kode_masuk" id="kode_masuk"  value="P{{$kode}}" readonly>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="tgl_masuk">Tanggal</label>
                                        <input type="date" class="form-control" name="tgl_masuk" id="tgl_masuk">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="pemasok_id">Toko</label>
                                        <select name="pemasok_id" id="pemasok_id" class="form-control">
                                            @foreach ($pemasok as $p)
                                            <option value="{{$p->id}}">{{$p->nama_pemasok}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <button type="button" class="btn btn-success float-right mt-4" data-toggle="modal" data-target="#modal-barang"><i class="fas fa-plus"></i> Tambah Barang</button>
                                    </div>
                                    <input type="hidden" name="users_id" id="users_id" value="{{auth()->user()->id()}}">
                                </div>
                            </form>
                        </div>
                      </div>
                      
                      <div class="row">
                            <div class="col-xl-10">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-shopping-cart mr-1"></i>
                                        Pembelian
                                    </div>
                                
                                    @include('admin.pembelian.modal')
                                
                                    <div class="card-body">
                                        <div id="formTransaksi">
                                            <div class="table-responsive">
                                                <table class="table table-bordered data-pembelian" id="data-pembelian" width="100%" cellspacing="0">
                                                    <thead>
                                                        <tr>
                                                            <th>Kode Barang</th>
                                                            <th>Nama</th>
                                                            <th>Harga</th>
                                                            <th>Qty</th>
                                                            <th>Total</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td style="display: none"></td>
                                                            <td style="display: none"></td>
                                                            <td style="display: none"></td>
                                                            <td style="display: none"></td>
                                                            <td style="display: none"></td>
                                                            <td style="display: none"></td>
                                                        </tr>      
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                          {{-- Total, submit, hidden --}}
                            <div class="col-xl-2">
                                <div class="card mb-4">
                                      <div class="card-header">
                                          <i class="fas fa-receipt"></i>
                                          Total Pembelian
                                      </div>
                                      <div class="card-body">
                                          <form action="" method="post" id="formTransaksi">
                                            <div class="form-row">
                                                <div class="form-group">
                                                    <label for="">Total Harga</label>
                                                    <input type="text" name="totalHarga" id="totalHarga" class="form-control" value="0" required="required">
                                                </div>
                                                <button type="button" class="btn btn-success form-control">Simpan Transaksi</button>
                                            </div>
                                          </form>
                                      </div>
                                </div>  
                            </div>
                            
                        </div>
                    </div>
                </main>
              @include('admin.templates.footer')
          </div>
      </div>    
  </body>

  @endsection
  @push('script')
  <script>
    var totalHarga = 0;
    function tambahBarang(a){
        let d = $(a).closest('tr');
        let kodeBarang = d.find('td:eq(1)').text();
        let namaBarang = d.find('td:eq(2)').text();
        let hargaBarang = d.find('td:eq(3)').text();
        let data = '';
        let tbody = $('#data-pembelian tbody tr td').text();
        data += '<tr>';
        data += '<td>'+kodeBarang+'</td>';
        data += '<td>'+namaBarang+'</td>';
        data += '<td>'+hargaBarang+'</td>';
        data += '<td><input type="number" value="1" min="1" class="qty form-control"></td>';
        data += '<td><span class="subTotal">'+hargaBarang+'</span></td>';
        data += '<td><button type="button" class="btnRemoveBarang btn btn-danger"><i class="fas fa-trash"></i></button></td>';
        data += '</tr>';
        if(tbody == 'Belum ada data') $('#data-pembelian tbody tr').remove();

        $('#data-pembelian tbody').append(data);
        totalHarga += parseFloat(hargaBarang);
        $('#totalHarga').val(totalHarga);
        $('#modal-barang').modal('hide');
    }

    function calcSubTotal(a){
        let qty = parseInt($(a).closest('tr').find('.qty').val());
        let hargaBarang = parseFloat($(a).closest('tr').find('td:eq(2)').text());
        let subTotalAwal = parseFloat($(a).closest('tr').find('.subTotal').text());
        let subTotal = qty * hargaBarang;
        totalHarga += subTotal - subTotalAwal;
        $(a).closest('tr').find('.subTotal').text(subTotal);
        $('#totalHarga').val(totalHarga);
    }

    $(function(){
        // dataTable
        // table pembelian
        let tablePembelian = $('#data-pembelian').DataTable();

        // table barang (modal)
        let tableBarang = $('#table-barang').DataTable();

        // pemilihan barang
        $('#table-barang').on('click', '.pilihBarangBtn', function(){
            tambahBarang(this);
        });

        // change qty event
        $('body').on('change', '.qty', function(){
            calcSubTotal(this);
        });

        $('body').on('click', '.btnRemoveBarang', function(){
            let subTotalAwal = parseFloat($(this).closest('tr').find('.subTotal').text());
            totalHarga -= subTotalAwal;

            $currentRow = $(this).closest('tr').remove();
            $('#totalHarga').val(totalHarga);
        });
    });
  </script>
  @endpush
   
</html>
