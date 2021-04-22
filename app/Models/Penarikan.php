<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penarikan extends Model
{
    use HasFactory;
    protected $primarykey = 'id';
    protected $table = 'penarikan_barang';
    protected $fillable = ['barang_id', 'tgl_expired', 'ditarik'];

    public function barang(){
        return $this->belongsTo('\App\Models\Barang', 'barang_id', 'id');
    }

    public function check(){
        $today = strtotime(date('Y-m-d'));
        $exp = strtotime($this->attributes['tgl_expired']);
        if($today >= $exp){
            return 1;
        }
        return 0;
    }
    // public static function kodeOtomatis(){
    //     $kode = sprintf('%03d',random_int(1, 999));
    //     $temp = [];
    //     foreach(Penarikan::all(["kode"]) as $item){
    //         array_push($temp, $item->kode);
    //     }while(in_array($kode, $temp, true)){
    //         $kode = sprintf('%03d', random_int(1, 999));
    //     }
    //     return $kode;
    // }
}
