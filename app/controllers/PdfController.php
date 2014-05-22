<?php

class PdfController extends \BaseController
{
    public function postPdf()
    {
        $data = json_decode(Input::get('postMembers'), true);

        $timestamp = date("d-m-Y");

        $pdf = App::make('dompdf');
        $pdfPage = View::make('pdf.session_members')->with('data', $data);
        $pdf->loadHTML($pdfPage);

        //return  $pdf->stream($timestamp.'.pdf'); /* for testing */
        return  $pdf->download($timestamp.'.pdf');
    }
}