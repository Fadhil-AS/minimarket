<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
<center>Penarikan</center>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Tanggal Expired</th>
            <th>Stok</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @php
            $no = 1;
        @endphp
        @foreach ($penarikan as $r)
            <tr>
                <td>{{$no++}}</td>
                <td>{{$r->barang->kode_barang}}</td>
                <td>{{$r->barang->nama_barang}}</td>
                <td>{{$r->tgl_expired}}</td>
                <td>{{$r->barang->stok}}</td>
                <td>
                    @if ($r->check())
                        DITARIK
                    @else
                        TIDAK DITARIK
                    @endif
                </td>    
            </tr>    
        @endforeach    
    </tbody>
</table>