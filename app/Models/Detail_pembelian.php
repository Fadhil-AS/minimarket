<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail_pembelian extends Model
{
    use HasFactory;
    protected $primarykey = 'id';
    protected $table = 'detail_pembelian';
    protected $fillable = ['pembelian_id', 'barang_id', 'harga_beli', 'jumlah', 'sub_total'];
}
