<?php

namespace App\Traits;

use App\Models\Periode;

trait PeriodeTraits {
    
    public function getSemproActive()
    {
        $sempro = Periode::where('type', 'Sempro')
            ->where('status', 'Active')
            ->first();

        return $sempro ? $sempro->id : null;
    }

    public function getSidangActive()
    {
        $sidang = Periode::where('type', 'TA')
            ->where('status', 'Active')
            ->first();
        
        return $sidang ? $sidang->id : null;
    }
}