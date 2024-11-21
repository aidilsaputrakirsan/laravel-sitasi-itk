<?php

namespace App\Services;

use Barryvdh\DomPDF\PDF;

class PdfService
{
    private PDF $pdf;

    public function __construct(PDF $pdf)
    {
        $this->pdf = $pdf;
    }

    public function exportDocument($view, $data, $name)
    {
        $document = $this->pdf->loadView($view, $data);

        return $document->download("$name.pdf");
    }

    public function loadView($view, $data, $landscape = false, $paper = 'a4')
    {
        $document = $this->pdf->loadView($view, $data);
        $orientation = $landscape ? 'landscape' : 'potrait';
        $document->setPaper($paper, $orientation);

        return $document->stream();
    }
}