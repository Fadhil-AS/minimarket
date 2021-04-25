<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    use HasFactory;
    protected $primarykey = 'id';
    protected $table = 'pembelian';
    protected $fillable = [
        'kode_masuk', 'tgl_masuk', 'total', 'pemasok_id', 'users_id'
    ];

    public function barang(){
        return $this->hasOne('\App\Models\Barang', 'barang_id', 'id');
    }
    public function pemasok(){
        return $this->hasOne('\App\Models\Pemasok', 'pemasok_id', 'id');
    }

    public function users(){
        return $this->hasOne('\App\Models\User', 'users_id', 'id');
    }

    public static function kodeOtomatis(){
        $kode = sprintf('%03d',random_int(1, 999));
        $temp = [];
        foreach(Pembelian::all(["kode_masuk"]) as $item){
            array_push($temp, $item->kode);
        }while(in_array($kode, $temp, true)){
            $kode = sprintf('%08d', random_int(1, 99999999));
        }
        return $kode;
    }
}
