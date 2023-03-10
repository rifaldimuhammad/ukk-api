<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pesananModel extends Model
{
    use HasFactory;
    protected $table = 'pesanan';
    protected $primaryKey = "id";
    protected $fillable  = [
        'id_menu',
        'id_pesanan',
        'jumlah_pesanan',
        'total_harga',
        'tunai',
        'no_meja',
        'waktu',
        'ekstra_waktu'
    ];
    public function menus()
    {
        return $this->belongsTo(menuModel::class, 'id_menu', 'id');
    }
}
