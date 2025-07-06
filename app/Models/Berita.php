<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    protected $table = 'berita'; // Nama tabel di database
    protected $fillable = ['judul', 'url', 'sumber']; // Kolom yang bisa diisi
}
