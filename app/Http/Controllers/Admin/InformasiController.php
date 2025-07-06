<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Laporan;

class InformasiController extends Controller
{
    public function index(Request $request)
    {
        $query = Laporan::query();

        // Ambil status dari request
        $status = $request->status;

        // Filter berdasarkan status jika ada
        if (!empty($status)) {
            $query->where('status', $status);
        }

        // Ambil data laporan terbaru
        $laporan = $query->latest()->get(); // Bisa diganti paginate(10) jika butuh pagination

        // Kirim data ke view
        return view('admin.informasi', compact('laporan', 'status'));
    }
}
