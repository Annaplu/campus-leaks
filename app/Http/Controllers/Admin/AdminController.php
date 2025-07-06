<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Berita;
use App\Models\Laporan;
use Illuminate\Support\Facades\Artisan;


class AdminController extends Controller
{
    public function index()
    {
        $berita = Berita::where('sumber', 'Metanoiac')->orderBy('created_at', 'desc')->get();
        $laporan = Laporan::latest()->take(5)->get();
        $jumlahMenunggu = Laporan::where('status', 'menunggu')->count();
        $jumlahSelesai = Laporan::where('status', 'selesai')->count();
        $totalPengguna = User::where('role', '!=', 'admin')->count();

        return view('admin.dashboard', compact(
            'berita',
            'laporan',
            'jumlahMenunggu',
            'jumlahSelesai',
            'totalPengguna'
        ));
    }

    public function ambil_berita()
    {
        Artisan::call('scrape:metanoiac');
        return redirect()->route('admin.dashboard')->with('success', 'Berita berhasil diambil dari metanoiac.id');
    }

    public function toggleBanner($id)
    {
        $berita = Berita::findOrFail($id);
        $berita->is_banner = !$berita->is_banner;
        $berita->save();

        return back()->with('success', 'Status banner berhasil diperbarui.');
    }
}
