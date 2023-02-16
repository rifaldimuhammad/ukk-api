<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invoiceModel extends Model
{
    use HasFactory;
    protected $table = 'invoice';
    protected $primaryKey = "id";
    protected $fillable  = [
        'id_menu',
        'id_pesanan',
        'jumlah_pesanan',
        'total_harga',
        'no_meja',
        'waktu',
        'ekstra_waktu'
    ];
}
