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
                      <h1 class="mt-4">Users</h1>
                      <ol class="breadcrumb mb-4">
                          <li class="breadcrumb-item active">Users</li>
                      </ol>
                      <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-user"></i>
                            Users
                            <button class="btn btn-sm btn-success float-right" data-toggle="modal" data-target="#create-users"><i class="fas fa-plus"></i> Tambah</button>
                        </div>

                        @include('admin.templates.feedback')
                        @include('admin.users.create')
                        @include('admin.users.detail')
                        @include('admin.users.edit')

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="data-users" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $r)
                                            <tr>
                                                <td> {{$r->name}} </td>
                                                <td>{{$r->email}}</td>
                                                <td>
                                                    <button class="btn btn-group">
                                                        <a href="#detail" data-id="{{$r->id}}" class="btn btn-sm btn-dark mr-2 detail" data-toggle="modal" data-target="#detail-users"><i class="far fa-id-card"></i></a>
                                                        <a href="#edit" data-id="{{$r->id}}" class="btn btn-sm btn-warning mr-2 trigger" data-toggle="modal" data-target="#edit-users"><i class="far fa-edit"></i></a>
                                                        <form action="/admin/users/" method="post" id="delete-form">
                                                            @method('delete')
                                                            @csrf
                                                            <a href="#delete" data-id="{{$r->id}}" class="btn btn-sm btn-danger delete"><i class="far fa-trash-alt"></i></a>
                                                        </form>
                                                    </button>
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
        // dataTable
        $('#data-users').DataTable({
            "paging" : true
        });

        // tambah data
        let formAdd = $('#add-form');
        $('body').on('click', '#btn-tambah', function(event){
            event.preventDefault();
            console.log($('#' + formAdd.attr('id')).attr('action'));
            console.log($('#' + formAdd.attr('id')).attr('method'));
            console.log($('#' + formAdd.attr('id')).serialize());
            jQuery.ajax({
                url: $('#' + formAdd.attr('id')).attr('action'),
                type: $('#' + formAdd.attr('id')).attr('method'),
                data: $('#' + formAdd.attr('id')).serialize(),
                error: function(result) {
                    console.log(result);
                    // defaultState();
                    let error = result['responseJSON']['errors'];
                    for (let buffer in error) {
                        $('#' + buffer).addClass('is-invalid');
                        $('div#invalid-feedback-' + buffer).text(error[buffer]);
                    }
                },
                success: function(result) {
                console.log(result);
                    if (result) {
                        // console.log('Data berhasil disimpan');
                        Swal.fire({
                            title: 'Data berhasil disimpan',
                            icon: 'success'
                        }).then((tambah) => {
                            console.log(tambah);
                            if (tambah) location.reload();
                        });
                    } else {
                      Swal.fire({
                            title: 'Data gagal disimpan',
                            icon: 'error',
                            button: 'Ok',
                            setTimeout: 5000
                        }).then((tambah) => {
                            console.log(tambah);
                            if (tambah) location.reload();
                        });
                    }
                }
            });
        });

        // detail
        $('body').on('click', 'a.detail', function(event){
            event.preventDefault();
            let data = JSON.parse("{{ $users ?? '' }}".replaceAll('&quot;', "\""));
            data = data.find(obj => obj.id == $(this).data('id'));
            let text = $('span.txt-detail');
            for (let i = 0; i < text.length; i++){
                text.eq(i).text(data[text.eq(i).attr('id')]);
            }
        });

        // edit
        let formEdit = $('#edit-form');
        $('body').on('click', 'a.trigger', function(event){
            event.preventDefault();
            let defaultRoute = formEdit.attr('action');
            let id = $(this).data('id') ? $(this).data('id') : null;
            formEdit.attr('action', `${defaultRoute}/${id}`);
            console.log($(this).data('id'));
            let data = JSON.parse("{{ $users ?? '' }}".replaceAll('&quot;', "\""));
            data = data.find(obj => obj.id == $(this).data('id'));
            console.log(data);
            let input = $('.form-control');
            for (let i = 0; i < input.length; i++) {
                input.eq(i).val(data[input.eq(i).attr('name')]).trigger('change');
                // input.eq(i).input(data[input.eq(i).attr('id')]);
            }
        });

        $('body').on('click', '#btn-edit', function(event){
            event.preventDefault();
            jQuery.ajax({
                url: $('#' + formEdit.attr('id')).attr('action'),
                type: $('#' + formEdit.attr('id')).attr('method'),
                data: $('#' + formEdit.attr('id')).serialize(),
                error: function(result) {
                    // defaultState();
                    let error = result['responseJSON']['errors'];
                    for (let buffer in error) {
                        $('#' + buffer).addClass('is-invalid');
                        $('#invalid-feedback-' + buffer).text(error[buffer]);
                    }
                },
                success: function(result) {
                    console.log(result);
                    if (result) {
                        // console.log('Data berhasil disimpan');
                        Swal.fire({
                            title: 'Data berhasil disimpan',
                            icon: 'success'
                        }).then((update) => {
                            console.log(update);
                            if (update) location.reload();
                        });
                    } else {
                        Swal.fire({
                            title: 'Data gagal disimpan',
                            icon: 'error',
                            button: 'Ok',
                            setTimeout: 5000
                        }).then((update) => {
                            console.log(update);
                            if (update) location.reload();
                        });
                    }
                }
            });
        });

        // delete
        let formDelete = $('#delete-form');
        $('body').on('click', 'a.delete', function(event){
            console.log('euyyyyy');
            let id = $(this).data('id');
            console.log(id);
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
                    $.post({
                        url: formDelete.attr('action') + id,
                        type: 'post',
                        data: formDelete.serialize(),
                        error: function(result){
                        console.log(result);
                        Swal.fire({
                            title: 'Data gagal dihapus',
                            icon: 'error'
                        }).then(function(dlt) {
                            if(dlt) location.reload();
                        });
                        
                        },
                        success: function(result){
                        Swal.fire({
                            icon: 'success', 
                            title: 'Data berhasil dihapus!'
                        }).then(function(dlt) {
                            if(dlt) location.reload();
                        });
                        
                        }
                    });
                }
            });
        });
    });
  </script>
  @endpush
   
</html>
