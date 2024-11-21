<?php

namespace App\Http\Controllers;

use App\Models\Periode;
use Illuminate\Http\Request;

class PeriodeController extends Controller
{
    public function store(Request $request)
    {
        Periode::create([
            'periode' => $request->periode,
            'gelombang' => $request->gelombang,
            'type' => 'TA',
            'semester' => $request->semester,
        ]);

        return back()->with('success', 'Periode telah ditambahkan');
    }

    public function storePeriodeSempro(Request $request)
    {
        Periode::create([
            'periode' => $request->periode,
            'gelombang' => $request->gelombang,
            'type' => 'Sempro',
            'semester' => $request->semester,
        ]);

        return back()->with('success', 'Periode telah ditambahkan');
    }
}
