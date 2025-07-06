<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $table = 'laporans';

    // Kolom yang boleh diisi secara massal
    protected $fillable = [
        'user_id',
        'nama',
        'jurusan',
        'judul',
        'kategori' => 'array',
        'deskripsi',
        'lokasi',
        'bukti',
        'hubungan',
        'identitas',
        'status',
        'tanggal_masuk',
    ];

    // Jika 'bukti' adalah tipe JSON, kamu bisa atur casting-nya:
    protected $casts = [
        'bukti' => 'array',
        'tanggal_masuk' => 'datetime',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
