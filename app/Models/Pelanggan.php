<?php

namespace App\Models;

use Database\Factories\PelangganFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;
    protected $primarykey = 'id';
    protected $table = 'pelanggan';
    protected $fillable = ['kode_pelanggan', 'nama', 'alamat', 'no_telp', 'email'];
}
