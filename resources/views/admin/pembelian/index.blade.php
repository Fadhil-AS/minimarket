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
                    <form action="" method="post" id="formTransaksi">
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
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="kode_masuk">Kode Masuk</label>
                                    <input type="text" class="form-control" name="kode_masuk" id="kode_masuk"  value="P{{$kode}}" readonly>
                                    <div id="invalid-feedback-kode_masuk" class="invalid-feedback"></div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="tgl_masuk">Tanggal</label>
                                    <input type="date" class="form-control" name="tgl_masuk" id="tgl_masuk">
                                    <div id="invalid-feedback-tgl_masuk" class="invalid-feedback"></div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="pemasok_id">Toko</label>
                                    <select name="pemasok_id" id="pemasok_id" class="form-control">
                                        @foreach ($pemasok as $p)
                                            <option value="{{$p->id}}">{{$p->nama_pemasok}}</option>
                                        @endforeach
                                    </select>
                                    <div id="invalid-feedback-pemasok_id" class="invalid-feedback"></div>
                                </div>
                                {{-- <div class="form-group col-md-6">
                                    
                                </div> --}}
                                <div class="form-group col-md-6">
                                    <button type="button" class="btn btn-success float-right mt-4" data-toggle="modal" data-target="#modal-barang"><i class="fas fa-plus"></i> Tambah Barang</button>
                                </div>
                                <input type="hidden" name="users_id" id="users_id" value="{{auth()->user()->id}}">
                            </div>
                        </div>
                      </div>
                      
                      <div class="row">
                            <div class="col-xl-10">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-shopping-cart mr-1"></i>
                                        Pembelian
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <div hidden id="data">{{$barang}}</div>
                                            <table class="table table-bordered data-pembelian"  width="100%"cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th>Kode Barang</th>
                                                        <th>Nama</th>
                                                        <th>Harga</th>
                                                        <th>Qty</th>
                                                        <th>Total</th>
                                                        <th>Aksi</th>
                                                        <th>Id Barang</th>
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
                                                        <td style="display: none"></td>
                                                    </tr>      
                                                </tbody>
                                            </table>
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
                                            <div class="form-row">
                                                <div class="form-group">
                                                    <label for="total">Total Harga</label>
                                                    <input type="text" name="total" id="total" class="form-control" value="0" required="required">
                                                </div>
                                                <button type="button" id="btn-submit" class="btn btn-success form-control">Simpan Transaksi</button>
                                            </div>
                                      </div>
                                </div>  
                            </div>    
                        </div>
                    </form>
                    @include('admin.pembelian.modal')
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
        data += '<td><input type="number" name="qty" id="qty" value="1" min="1" class="qty form-control"></td>';
        data += '<td><span class="subTotal">'+hargaBarang+'</span></td>';
        data += '<td><button type="button" class="btnRemoveBarang btn btn-danger"><i class="fas fa-trash"></i></button></td>';
        data += '</tr>';
        if(tbody == 'Belum ada data') $('#data-pembelian tbody tr').remove();

        $('#data-pembelian tbody').append(data);
        totalHarga += parseFloat(hargaBarang);
        $('#total').val(totalHarga);
        $('#modal-barang').modal('hide');
    }

    function calcSubTotal(a){
        let qty = parseInt($(a).closest('tr').find('.qty').val());
        let hargaBarang = parseFloat($(a).closest('tr').find('td:eq(2)').text());
        let subTotalAwal = parseFloat($(a).closest('tr').find('.subTotal').text());
        let subTotal = qty * hargaBarang;
        totalHarga += subTotal - subTotalAwal;
        $(a).closest('tr').find('.subTotal').text(subTotal);
        $('#total').val(totalHarga);
    }

    $(function(){
        let modal = {
            "modal" : $('#modal-barang')
        }

        // dataTable
        // table pembelian
        let tablePembelian = $('.data-pembelian').DataTable();

        // table barang (modal)
        let tableBarang = $('#table-barang').DataTable();

        let form = $('form#formTransaksi');
        let input = $('.form-control.data');
        let route = form.attr('action');

        function request(route, type, data = null){
            let buffer = null;
            buffer = jQuery.ajax({
                async: false,
                url: route,
                type: type,
                data: data,
            }).always(function(a, b, c){console.log(c)});
            return buffer;
        }

        function justalert(icon, title, text){
            Swal.fire(
                title, text, icon
            ).then((result)=>{
                if(result.value) location.reload();
            });
        }

        // pemilihan barang
        $('body').on('click', '.pilihBarangBtn', function(e){
            // tambahBarang(this);
            e.preventDefault();
            let data = JSON.parse($('#data').text());
            let id = $(this).data('id');
            let tbody = $('#data-pembelian tbody tr td').text();

            data = data.find(obj => obj.id == id);
            modal["modal"].modal('hide');
            console.log(data);

            let barangId = `<input class="form-control data" type="text" name="barang_id[]" id="barang_id" value="${data.id}">`;
            let kodeBarang = `<div>${data.kode_barang}</div>`;
            let namaBarang = `<div>${data.nama_barang}</div>`;
            let hargaBarang = `<div>${data.harga_jual}</div>`;
            let qty =  `<div><input type="number" name="qty[]" id="qty" value="1" min="1" class="qty form-control"></div>`;
            let subTotal = `<div class="subTotal">${data.harga_jual}</div>`;
            let action = `<div><button type="button" class="btnRemoveBarang btn btn-danger"><i class="fas fa-trash"></i></button></div>`;

            tablePembelian.row.add([
                kodeBarang, namaBarang, hargaBarang, qty, subTotal, action, barangId
            ]).draw();

            if(tbody == 'Belum ada data') $('#data-pembelian tbody tr').remove();

            $('#data-pembelian tbody').append(data);
            totalHarga += parseInt($(hargaBarang).text());
            console.log(totalHarga);
            $('#total').val(totalHarga);
        });

        // change qty event
        $('body').on('change', '.qty', function(){
            calcSubTotal(this);
        });

        $('body').on('click', '.btnRemoveBarang', function(){
            let subTotalAwal = parseFloat($(this).closest('tr').find('.subTotal').text());
            totalHarga -= subTotalAwal;

            $currentRow = $(this).closest('tr').remove();
            $('#total').val(totalHarga);
        });

        $('body').on('click', '#btn-submit', function(event){
            event.preventDefault();
            let form = $('#formTransaksi').serialize();
            console.log(form);
            let csrf = $(`@csrf`).serialize();
            let res = request("{{route('pembelian.index')}}", "post", `${form}&${csrf}`);
            console.log(res);

            if(res['status'] == 200){
                result = JSON.parse(res['responseText']);
                if(result['status']){
                    modal["modal"].modal('hide');
                    justalert('success', 'Berhasil', result['message']);
                }else{
                    modal["modal"].modal('hide');
                    justalert('error', 'Gagal', result['message']);
                }
            }else{
                let error = res['responseJson']['errors'];
                for (let buffer in error){
                    $('#' + buffer).addClass('is-invalid');
                    $('#invalid-feedback-' + buffer).text(error[buffer]);
                }
            }
        });
    });
  </script>
  @endpush
   
</html>
