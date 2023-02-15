<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mejaModel extends Model
{
    use HasFactory;
    protected $primaryKey = "id";
    protected $table = 'tempat';
    protected $fillable = [
        'option',
        'status',
        'no_meja',
    ];
}
