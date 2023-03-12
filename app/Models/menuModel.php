<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class menuModel extends Model
{
    use HasFactory;
    protected $table = 'menu';
    protected $primaryKey = "id";
    protected $fillable  = [
        'nama',
        'deskripsi',
        'kategori',
        'harga',
        'cover'
    ];

    public function pesanan()
    {
        return $this->hasMany(keranjangModel::class, 'id_menu', 'id');
    }
    public function pesananDetail()
    {
        return $this->hasMany(pesananDetail::class, 'id_menu', 'id');
    }
}
