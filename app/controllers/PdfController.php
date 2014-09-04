<?php

use PdfHelper;

class PdfController extends \BaseController
{


    public function postPdf()
    {
        $sessionmembers = json_decode(Input::get('postMembers'), true);
        $evercisesession = Input::get('postEverciseSession');
        $evercisegroup = Input::get('postEverciseGroup');

        $timestamp = date("d-m-Y");


        $pdfPage = PdfHelper::pdfView($evercisegroup, $evercisesession, $sessionmembers);

        return PDF::load($pdfPage, 'A4', 'portrait')->download($evercisegroup.'-'.$timestamp);

    }

}