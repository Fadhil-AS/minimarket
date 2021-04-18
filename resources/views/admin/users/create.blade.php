<div class="modal fade" id="create-users" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Form Users</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="add-form" action="{{url('/admin/users')}}" method="POST">
            @csrf
            <div class="form-group">
              <label for="name">Nama</label>
              <input type="text" class="form-control" name="name" id="name" placeholder="Masukan nama" autocomplete="off">
              <div id="invalid-feedback-name" class="invalid-feedback"></div>
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" class="form-control" name="email" id="email" placeholder="Masukan email" autocomplete="off">
              <div id="invalid-feedback-email" class="invalid-feedback"></div>
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control" name="password" id="password" placeholder="Masukan password" autocomplete="off">
              <div id="invalid-feedback-password" class="invalid-feedback"></div>
            </div>
            <button type="submit" id="btn-tambah" class="btn btn-primary">Simpan</button>
          </form>
        </div>
      </div>
    </div>
</div>