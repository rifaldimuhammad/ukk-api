<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pesananDetail extends Model
{
    use HasFactory;
    protected $table = 'pesanan_detail';
    protected $fillable = [
        'id_pesanan',
        'id_menu',
        'jumlah_pesanan',
        'sub_total',
    ];
    public function menu()
    {
        return $this->belongsTo(menuModel::class, 'id_menu', 'id');
    }
}
