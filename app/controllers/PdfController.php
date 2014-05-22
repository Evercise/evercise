<?php

class PdfController extends \BaseController
{
    public function getSample()
    {
        $pdf = new TCPDF();
 /*
        $pdf->SetPrintHeader(false);
        $pdf->SetPrintFooter(false);
        $pdf->AddPage();
        $pdf->Text(90, 140, 'This is a test');
        $filename = storage_path() . '/test.pdf';
        $pdf->output($filename, 'F');
 
        return Response::download($filename);
*/
    }
}