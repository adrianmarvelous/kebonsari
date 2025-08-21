<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\agenda;

class InformasiUmumController extends Controller
{
    public function informasi_umum()
    {
        $agendas = agenda::with('lampiran')
                            ->orderBy('created_at', 'desc')
                            ->take(3)   // or ->limit(3)
                            ->get();

        return view('web.informasi_umum.index',compact('agendas'));
    }

    public function detail($id)
    {
        $agenda = agenda::with('lampiran')->findOrFail($id);
        return view('web.informasi_umum.detail', compact('agenda'));
    }
}
