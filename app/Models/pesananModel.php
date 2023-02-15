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
        'id_user',
        'id_menu',
        'harga_menu',
        'jumlah_menu',
        'total_harga',
    ];

    public function menu()
    {
        return $this->belongsTo(menuModel::class, 'id_menu', 'id');
    }
}
