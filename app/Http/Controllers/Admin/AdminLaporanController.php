<?php

namespace App\Http\Controllers\Admin;

use App\Models\Laporan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminLaporanController extends Controller
{
    public function detail($id)
    {
        $laporan = Laporan::findOrFail($id);
        return view('admin.laporan.detail', compact('laporan'));
    }
    public function validasi(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Diterima,Ditolak',
        ]);

        $laporan = Laporan::findOrFail($id);
        $laporan->status = $request->status;
        $laporan->save();

        return redirect()->route('admin.laporan.detail', $id)->with('success', 'Status laporan berhasil diperbarui.');
    }
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Diterima,Ditolak,Diproses,Selesai',
            'komentar' => 'nullable|string|max:1000',
        ]);

        $laporan = Laporan::findOrFail($id);
        $laporan->status = $request->status;
        $laporan->komentar = $request->komentar;
        $laporan->save();

        return redirect()->route('admin.laporan.detail', $id)
            ->with('success', "Status laporan berhasil diperbarui menjadi {$request->status}");
    }
}

