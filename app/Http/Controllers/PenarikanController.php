<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Penarikan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PenarikanExport;
// use Barryvdh\DomPDF\PDF;
use Barryvdh\DomPDF\Facade as PDF;

class PenarikanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $kode = Penarikan::kodeOtomatis();
        $penarikan = Penarikan::all();
        $barang = Barang::all();
        return view('admin.penarikan.index',[
            // 'kode' => $kode,
            'penarikan' => $penarikan,
            'barang' => $barang
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
            'barang_id' => 'required',
            'tgl_expired' => 'required'
        ]);

        $status = Penarikan::create($request->all());
        if($status){
            return json_encode([
                "status" => 1,
                "message" => "Data berhasil ditambahkan!"
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
            'barang_id' => 'required',
            'tgl_expired' => 'required'
        ]);

        $status = DB::table('penarikan_barang')->where('id', $id)->update($request->all([
            'barang_id', 'tgl_expired'
        ]));
        if($status){
            return json_encode([
                "status" => 1,
                "message" => "Data telah diperbaharui!"
            ]);
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
        $delete = DB::table('penarikan_barang')->where('id', $id)->delete();
        if($delete) return 1;
        else return 0;
    }

    public function excel(){
        return Excel::download(new PenarikanExport, 'penarikan.xlsx');
    }

    public function pdf(){
        $penarikan = Penarikan::all();
        $pdf = PDF::loadview('admin.penarikan.penarikan_pdf', ['penarikan' => $penarikan]);
        return $pdf->download('penarikan.pdf');
    }
}
