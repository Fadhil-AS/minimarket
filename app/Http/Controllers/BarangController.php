<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Barang;
use App\Models\Produk;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lastId = Barang::select('kode_barang')->orderBy('created_at', 'desc')->first();
        $kode = ($lastId == null ? 'K00000001' : sprintf('K%08d', substr($lastId->kode_barang, 1)+1));
        $barang = Barang::all();
        $produk = Produk::all();
        return view('admin.barang.index', [
            'kode' => $kode,
            'barang' => $barang,
            'produk' => $produk
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_barang' => 'required',
            'produk_id' => 'required',
            'nama_barang' => 'required',
            'satuan' => 'required',
            'harga_jual' => 'required',
            'stok' => 'required'
        ]);

        $status = Barang::create($request->all());
        
        if($status){
            return json_encode([
                "status" => 1,
                "message" => "Data Berhasil ditambahkan!"
            ]);
        }else{
            return json_encode([
                "status" => 0,
                "message" => "Data gagal ditambahkan!"
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_barang' => 'required',
            'produk_id' => 'required',
            'nama_barang' => 'required',
            'satuan' => 'required',
            'harga_jual' => 'required',
            'stok' => 'required'
        ]);

        $status = DB::table('barang')->where('id', $id)->update($request->all([
            'kode_barang', 'produk_id', 'nama_barang', 'satuan', 'harga_jual', 'stok', 'users_id'
        ]));

        if($status){
            return json_encode([
                "status" => 1,
                "message" => "Data Berhasil diperbaharui!"
            ]);
        }else{
            return json_encode([
                "status" => 0,
                "message" => "Data gagal diperbaharui!"
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = DB::table('barang')->where('id', $id)->delete();
        if($delete) return 1;
        return 0;
    }
}
