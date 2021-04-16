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
}
