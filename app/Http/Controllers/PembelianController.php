<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembelian;
use App\Models\Barang;
use App\Models\Detail_pembelian;
use App\Models\Pemasok;
use Illuminate\Support\Facades\Auth;

class PembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kode = Pembelian::kodeOtomatis();
        $pembelian = Pembelian::all();
        $barang = Barang::all();
        $pemasok = Pemasok::all();
        return view('admin.pembelian.index', [
            'kode' => $kode,
            'pembelian' => $pembelian,
            'barang' => $barang,
            'pemasok' => $pemasok
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
        // return $request;
        $pembelian = [
            'kode_masuk' => $request->kode_masuk,
            'tgl_masuk' => $request->tgl_masuk,
            'total' => $request->total,
            'pemasok_id' => $request->pemasok_id,
            'users_id' => Auth::id()
        ];

        $status = Pembelian::create($pembelian);

        $pembelianId = Pembelian::select('id')->orderBy('created_at', 'desc')->first()->id;
        $detail_pembelian = [];
        for($i = 0; $i < count($request->barang_id); $i++){
            $buffer = Barang::find($request->barang_id[$i]);
            $detail_pembelian[$i] = [
                'pembelian_id' => $pembelianId,
                'barang_id' => $request->barang_id[$i],
                'harga_beli' => $buffer->harga_jual,
                'jumlah' => $request->qty[$i],
                'sub_total' => $buffer->harga_jual * intval($request->qty[$i])
            ];
            $status = Detail_pembelian::create($detail_pembelian[$i]);
            if(!$status){
                return json_encode([
                    "status" => 0,
                    "message" => "Data Gagal disimpan!"
                ]);
            }
        }
        
        return json_encode([
            "status" => 1,
            "message" => "Data Berhasil Disimpan!"
        ]);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
