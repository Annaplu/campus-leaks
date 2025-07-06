<?php

namespace App\Http\Controllers;
use App\Models\Berita;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $beritaBanner = Berita::where('is_banner', true)->latest()->take(5)->get();
        return view('dashboard', compact('beritaBanner'));
    }
}
