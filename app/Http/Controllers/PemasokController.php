<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Pemasok;

class PemasokController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pemasok = Pemasok::all();
        return view('admin/pemasokan/index',[
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
        $request->validate([
            'kode_pemasok' => 'required',
            'nama_pemasok' => 'required',
            'alamat' => 'required',
            'kota' => 'required',
            'no_telp' => 'required'
        ]);

        $status = Pemasok::create($request->all());
        if($status){
            return json_encode([
                "status" => 1,
                "message" => "Data berhasil disimpan!"
            ]);
        }else{
            return json_encode([
                "status" => 0,
                "message" => "Data gagal tersimpan!"
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
            'kode_pemasok' => 'required',
            'nama_pemasok' => 'required',
            'alamat' => 'required',
            'kota' => 'required',
            'no_telp' => 'required'
        ]);

        $status = DB::table('pemasok')->where('id', $id)->update($request->all([
            'kode_pemasok', 'nama_pemasok', 'alamat', 'kota', 'no_telp'
        ]));
        
        if($status){
            return json_encode([
                "status" => 1,
                "message" => "Data berhasil diperbaharui"
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
        $delete = DB::table('pemasok')->where('id', $id)->delete();
        if($delete) return 1;
        else return 0;
    }
}
