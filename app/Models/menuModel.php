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
        return $this->hasMany(pesananModel::class, 'id_menu', 'id');
    }
}
