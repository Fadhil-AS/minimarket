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
                      <h1 class="mt-4">Produk</h1>
                      <ol class="breadcrumb mb-4">
                          <li class="breadcrumb-item active">Produk</li>
                      </ol>
                      <div class="card mb-4">
                        <div class="card-header">
                            <i class="fab fa-empire"></i>
                            Produk
                            <button href="#add" class="btn btn-sm btn-success float-right trigger" data-title="Tambah Produk" data-mode="add" data-toggle="modal" data-target="#form-modal"><i class="fas fa-plus"></i> Tambah</button>
                        </div>

                        @include('admin.templates.feedback')
                        @include('admin.produk.modal')
                        @include('admin.produk.detail')
                        {{-- @include('admin.produk.edit') --}}

                        <div class="card-body">
                            <div class="table-responsive">
                                <div hidden id="data">{{$produk}}</div>
                                <table class="table table-bordered" id="data-produk" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nama Produk</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($produk as $r)
                                            <tr>
                                                <td> {{$r->nama_produk}} </td>
                                                <td>
                                                    <div class="btn btn-group">
                                                        <a href="#detail" data-id="{{$r->id}}" class="btn btn-sm btn-dark mr-2 detail" data-toggle="modal" data-target="#detail-produk"><i class="far fa-id-card"></i></a>
                                                        <button href="#edit" data-id="{{$r->id}}" data-mode="edit" data-title="Edit Produk" class="btn btn-sm btn-warning mr-2 trigger" data-toggle="modal" data-target="#form-modal"><i class="far fa-edit"></i></button>
                                                        <form action="{{route('produk.index')}}" method="post" id="delete-form">
                                                            @csrf
                                                            @method('delete')
                                                            <button href="#delete" data-id="{{$r->id}}" data-mode="delete" class="btn btn-sm btn-danger delete trigger"><i class="far fa-trash-alt"></i></button>
                                                        </form>
                                                    </div>
                                                </td>
                                          </tr>      
                                        @endforeach
                                      
                                    </tbody>
                                </table>
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
    $(function(){
        let modal = {
            "modal" : $('#form-modal'),
            "label" : $('#modal-label')
        }

        // dataTable
        let table = $('#data-produk').DataTable({
            "paging" : true
        });

        let form = $('form.form-produk');
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

        $('body').on('click', 'button.trigger', function(event){
            event.preventDefault();
            let data = JSON.parse($('#data').text());
            let mode = $(this).data('mode');
            let id = $(this).data('id') ? $(this).data('id') : null;
            console.log(data);
            if(mode == "add"){
                modal["label"].text($(this).data('title'));
                for(let i = 0; i < input.length; i++){
                    input.eq(i).attr('value', '');
                }
            }else if(mode == "edit"){
                modal["label"].text($(this).data('title'));
                data = data.find(obj => obj.id == id);
                form.attr('action', `${route}/${id}`);
                $('#method').attr('value', 'patch');
                for(let i = 0; i < input.length; i++){
                    input.eq(i).val(data[input.eq(i).attr('name')]).trigger("change");
                }
            }else if(mode == "delete"){
                Swal.fire({
                    title: 'Yakin ingin menghapus data ini?',
                    text: "Anda tidak akan mendapatkan data kembali",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus data ini!'
                }).then((result) => {
                    if (result.value) {
                        $('#method').attr('value', 'delete');
                        let res = request(`${route}/${id}`, 'post', form.serialize());
                        console.log(res);
                        if(res['status'] == 200){
                            justalert('success', 'Terhapus!', 'Data telah terhapus');
                        }else{
                            justalert('error', 'Gagal hapus data!', 'Data gagal dihapus');
                        }
                    }
                    else if(result.dismiss == Swal.DismissReason.cancel){
                        Swal.fire('Batal', 'Menghapus data dibatalkan!', 'error');
                    }
                });
            }
        });

        $('body').on('click', '#btn-submit', function(event){
            event.preventDefault();
            let res = request(form.attr('action'), 'post', form.serialize());
            console.log(res);
            if(res['status'] == 200){
                result = JSON.parse(res['responseText']);
                if(result['status']){
                    modal["modal"].modal('hide');
                    justalert('success', 'Data tersimpan', result['message']);
                }else{
                    modal["modal"].modal('hide');
                    justalert('error', 'Data gagal disimpan', result['message']);
                }
            }else{
                let error = res['responseJSON']['errors'];
                for (let buffer in error){
                    $('#' + buffer).addClass('is-invalid');
                    $('#invalid-feedback-' + buffer).text(error[buffer]);
                }
            }
        });

        // detail
        $('body').on('click', 'a.detail', function(event){
            event.preventDefault();
            let data = JSON.parse("{{ $produk ?? '' }}".replaceAll('&quot;', "\""));
            data = data.find(obj => obj.id == $(this).data('id'));
            let text = $('span.txt-detail');
            for (let i = 0; i < text.length; i++){
                text.eq(i).text(data[text.eq(i).attr('id')]);
            }
        });
    });
  </script>
  @endpush
   
</html>
