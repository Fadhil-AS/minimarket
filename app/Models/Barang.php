<?php

namespace App\Models;

use Database\Factories\BarangFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $primarykey = 'id';
    protected $table = 'barang';
    protected $fillable = ['kode_barang', 'produk_id', 'nama_barang', 'satuan', 'harga_jual', 'stok', 'users_id', 'keterangan', 'kategori_id'];

    public function produk(){
        return $this->hasOne('\App\Models\Produk', 'produk_id', 'id');
    }

    public function kategori(){
        return $this->hashOne('\App\Models\Kategori', 'kategori_id', 'id');
    }
}
