<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategori = Kategori::all();
        return view('admin.kategori.index', [
            'kategori' => $kategori
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
            'nama_kategori' => 'required'
        ]);

        $status = Kategori::create($request->all());
        if($status){
            return json_encode([
                "status" => 1,
                "message" => "Data berhasil disimpan!"
            ]);
        }else{
            return json_encode([
                "status" => 0,
                "message" => "Data gagal disimpan!"
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
            'nama_kategori' => 'required'
        ]);

        $status = DB::table('kategori')->where('id', $id)->update($request->all([
            'nama_kategori'
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
        $delete = DB::table('kategori')->where('id', $id)->delete();
        if($delete) return 1;
        else return 0;
    }
}
