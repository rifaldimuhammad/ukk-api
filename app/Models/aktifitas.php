<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class aktifitas extends Model
{
    use HasFactory;
    protected $table = 'aktifitas';
    protected $fillable = [
        'id_user',
        'nama_aktifitas',
        'read',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
