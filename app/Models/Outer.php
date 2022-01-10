<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outer extends Model
{
    use HasFactory;

    protected $table = "outer";

    protected $fillable = [
        'nama', 'harga', 'link', 'gambar'
    ];
}
