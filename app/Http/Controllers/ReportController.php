<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Laporan;

class ReportController extends Controller
{
    public function store(Request $request)
    {
        // Validasi inputan
        $request->validate([
            'jurusan' => 'required',
            'laporan' => 'required',
            'kategori' => ['required', 'array'],
            'kategori.*' => ['required', 'string'],
            'deskripsi' => 'required',
            'lokasi' => 'required',
            'hubungan' => 'required',
            'identitas' => 'required',
            'bukti.*' => 'nullable|file|max:102400|mimes:jpg,jpeg,png,mp4,mov,avi',
        ]);

        // Ambil kategori sebagai array, pastikan tetap array meski cuma satu
        $kategori = $request->input('kategori', []);
        if (!is_array($kategori)) {
            $kategori = [$kategori];
        }

        // Tambahkan kategori_lain jika opsi 'Yang Lain' dipilih
        if (in_array('Yang Lain', $kategori) && $request->filled('kategori_lain')) {
            $kategori[] = $request->input('kategori_lain');
        }

        // Tangani hubungan lain jika dipilih
        $hubungan = $request->input('hubungan');
        if ($hubungan === 'Yang lain' && $request->filled('hubungan_lain')) {
            $hubungan = $request->input('hubungan_lain');
        }

        // Simpan file bukti jika ada
        $buktiPaths = [];
        if ($request->hasFile('bukti')) {
            foreach ($request->file('bukti') as $file) {
                if ($file) {
                    $path = $file->store('bukti_laporan', 'public');
                    $buktiPaths[] = $path;
                }
            }
        }

        // Buat laporan baru
        $laporan = new Laporan();
        $laporan->user_id = Auth::id();
        $laporan->nama = Auth::user()->name;
        $laporan->jurusan = $request->jurusan;
        $laporan->judul = $request->laporan;
        $laporan->kategori = json_encode($kategori);
        $laporan->deskripsi = $request->deskripsi;
        $laporan->lokasi = $request->lokasi;
        $laporan->bukti = json_encode($buktiPaths);
        $laporan->hubungan = $hubungan;
        $laporan->identitas = $request->identitas;
        $laporan->status = 'Menunggu';
        $laporan->tanggal_masuk = now();
        $laporan->save();

        return redirect()->back()->with('success', 'Laporan berhasil dikirim.');
    }

    public function informasi()
    {
        $laporan = Laporan::all();
        return view('admin.informasi', compact('laporan'));
    }

    public function riwayat()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $reports = Laporan::where('user_id', Auth::id())->get();
        return view('riwayat', compact('reports'));
    }

    public function detail($id)
    {
        $report = Laporan::where('id', $id)
                         ->where('user_id', Auth::id())
                         ->firstOrFail();

        return view('riwayat_detail', compact('report'));
    }
}
