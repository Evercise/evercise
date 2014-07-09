<?php

class PdfController extends \BaseController
{
    public function postPdf()
    {
        $sessionmembers = json_decode(Input::get('postMembers'), true);
        $evercisesession = Input::get('postEverciseSession');
        $evercisegroup = Input::get('postEverciseGroup');

        $timestamp = date("d-m-Y");

       /*$pdf = App::make('dompdf');
        $pdfPage = View::make('pdf.session_members')
                ->with('evercisegroup', $evercisegroup)
                ->with('evercisesession', $evercisesession)
                ->with('sessionmembers', $sessionmembers);

        $pdf->loadHTML($pdfPage);

        //return var_dump($pdf);

        return  $pdf->stream($timestamp.'.pdf'); /* for testing */
        //return  $pdf->download($timestamp.'.pdf');


        $pdfPage = View::make('pdf.session_members')
                ->with('evercisegroup', $evercisegroup)
                ->with('evercisesession', $evercisesession)
                ->with('sessionmembers', $sessionmembers);

        return PDF::load($pdfPage, 'A4', 'portrait')->download($timestamp.'.pdf');

    }
}