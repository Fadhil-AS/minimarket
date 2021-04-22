<center>Penarikan PDF</center>
<table border="1" width="100%">
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