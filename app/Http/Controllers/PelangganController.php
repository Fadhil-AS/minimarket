<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Pelanggan;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pelanggan =  Pelanggan::all();
        return view('admin.pelanggan.index', [
            'pelanggan' => $pelanggan
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
            'kode_pelanggan' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
            'email' => 'required'
        ]);

        $status = Pelanggan::create($request->all());
        if($status){
            return json_encode([
                "status" => 1,
                "message" => "Data berhasil tersimpan!"
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
            'kode_pelanggan' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
            'email' => 'required'
        ]);

        $status = DB::table('pelanggan')->where('id', $id)->update($request->all([
            'kode_pelanggan', 'nama', 'alamat', 'no_telp', 'email'
        ]));
        
        if($status){
            return json_encode([
                "status" => 1,
                "message" => "Data berhasil diperbaharui!"
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
        $delete = DB::table('pelanggan')->where('id', $id)->delete();
        if($delete) return 1;
        else return 0;
    }
}
