<?php

namespace App\Models;

use Database\Factories\PemasokFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemasok extends Model
{
    use HasFactory;
    protected $primarykey = 'id';
    protected $table = 'pemasok';
    protected $fillable = ['kode_pemasok', 'nama_pemasok', 'alamat', 'kota', 'no_telp'];
}
